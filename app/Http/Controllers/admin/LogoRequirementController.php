<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\LogoRequirement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoRequirementController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:manage-logo-recruitment', ['only' => ['index','edit']]);
    }



    public function index()
    {
        if (Auth::check()) {
            $logoRequirements = LogoRequirement::all();
            return view('admin.logo_requirement.index', compact('logoRequirements'));
        }
        return redirect()->route('login');
    }


    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'company_name' => 'required',
            'products' => 'required',
            'logo_name' => 'required',
            'tagline' => 'nullable',
            'website' => 'nullable|url',
            'company_address' => 'nullable',
            'other_requirements' => 'nullable',
            'logotype' => 'nullable',
            'reference_file' => 'nullable',

        ]);

        $logoRequirement = new LogoRequirement();
        $logoRequirement->company_name = $request->company_name;
        $logoRequirement->products = $request->products;
        $logoRequirement->logo_name = $request->logo_name;
        $logoRequirement->tagline = $request->tagline;
        $logoRequirement->website = $request->website;
        $logoRequirement->company_address = $request->company_address;
        $logoRequirement->other_requirements = $request->other_requirements;
        $logoRequirement->logotype = $request->logotype;

        if ($request->hasFile('reference_file')) {
            $file = $request->file('reference_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/LogoRequirement'), $fileName);
            $logoRequirement->reference_file = 'uploads/LogoRequirement/' . $fileName;
        }


        $logoRequirement->save();

        return redirect()->back()->with('success', 'Logo requirement submitted successfully!');
    }


    public function edit($id)
    {

        if (Auth::check()) {
            $requirement = LogoRequirement::findOrFail($id);
            return view('admin.logo_requirement.edit', compact('requirement'));
        }
        return redirect()->route('login');
    }
}
