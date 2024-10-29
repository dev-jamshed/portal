<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QueryHelper
{
    public static function getLatestAssignment($queryId)
    {
        // Subquery to get latest assignment for the given query ID
        $latestAssignmentSubquery = DB::table('query_assignments')
            ->select('query_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->where('query_id', $queryId)
            ->groupBy('query_id');

        // Get the latest assignment details
        $latestAssignment = DB::table('query_assignments as qa')
            ->joinSub($latestAssignmentSubquery, 'latest', function ($join) {
                $join->on('qa.query_id', '=', 'latest.query_id')
                     ->on('qa.created_at', '=', 'latest.latest_created_at');
            })
            ->leftJoin('users as assigned_by', 'qa.assigned_by', '=', 'assigned_by.id')
            ->leftJoin('users as assigned_to', 'qa.assigned_to', '=', 'assigned_to.id')
            ->select(
                'qa.query_id',
                'qa.id as latest_assignment_id',
                'qa.created_at as latest_assignment_created_at',
                'assigned_by.name as assigned_by_name',
                'assigned_to.name as assigned_to_name'
            )
            ->first();

        return $latestAssignment;
    }
}

// Helper function should be outside the class
if (!function_exists('getProductNameById')) {
    function getProductNameById($categoryId) {
        $product = Product::find($categoryId);
        return $product ? $product->name : 'Unknown Product';
    }
}

if (!function_exists('getTodayAttendanceForUser')) {
    function getTodayAttendanceForUser($userId = null) {
        $userId = $userId ?? Auth::user()->id;

        return Attendance::where('uid', $userId)
            ->whereDate('date', now()->toDateString())
            ->first();
    }
}
