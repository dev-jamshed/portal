<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkFromHomePermission;
use PDO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OfficeWifiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // comment after live
        
        return $next($request);

        // dd($request->ip());
        if(Auth::user()->hasRole('super-admin')){
            return $next($request);
        }
        $officeIpAddresses = ["103.244.176.249", "192.168.1.0/24"];
        Log::debug('Hardcoded Office IP Addresses: ', $officeIpAddresses);
        // Get the user's IP address
        $userIp = $request->ip();


        $currentDate = date('Y-m-d');

        $workFromHomePermission = WorkFromHomePermission::where('employee_id', auth()->user()->id)
            ->where('date', $currentDate)
            ->first();

        if ($workFromHomePermission) {
            return $next($request);
        }

        function ip_in_range($ip, $range)
        {
            if (strpos($range, '/') !== false) {
                list($subnet, $bits) = explode('/', $range);
                $subnet = ip2long($subnet);
                $ip = ip2long($ip);
                $mask = -1 << (32 - $bits);
                $subnet &= $mask;
                return ($ip & $mask) === $subnet;
            } else {
                return $ip === $range;
            }
        }

        // Check if the user's IP is within the office IP range
        foreach ($officeIpAddresses as $officeIp) {
            if (ip_in_range($userIp, $officeIp)) {
                return $next($request);
            }
        }

        // If the user's IP is not within the office IP range, deny access
       Auth::logout();
       return new RedirectResponse(route('login'));
    }
}
