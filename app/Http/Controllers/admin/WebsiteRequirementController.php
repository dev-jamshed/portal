<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\WebsiteRequirement;
use App\Http\Controllers\Controller;

class WebsiteRequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage-web-recruitment', ['only' => ['index','edit']]);
    }

    public function index()
    {
        $websiteRequirements = WebsiteRequirement::all();
        return view('admin.web_requirement.index', compact('websiteRequirements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|string|max:255',
            'company_address' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'main_products' => 'required|string|max:255',
            'company_slogan' => 'nullable|string|max:255',
            'website_purpose' => 'required|string|max:255',
            'domain_name' => 'required|string|max:255',
            'competitor_website' => 'required|string|max:255',
            'client_role' => 'required|string|max:255',
            'color_theme' => 'nullable|string|max:255',
            'web_design_suggestion' => 'nullable|string|max:255',
            'company_introduction' => 'nullable|string|max:255',
            'categories_names' => 'nullable|string|max:255',
            'product_names' => 'nullable|string|max:255',
            'special_requirement' => 'nullable|string|max:255',
            'reference_file' => 'nullable||max:6048',
        ]);

        // return $request;
        if ($request->hasFile('reference_file')) {
            $file = $request->file('reference_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/WebsiteRequirement'), $fileName);
            $validated['reference_file'] = 'uploads/WebsiteRequirement/' . $fileName;
        }
        WebsiteRequirement::create($validated);

        return redirect()->route('website_requirements.create')->with('success', 'Website requirement added successfully.');
    }
    public function edit($id)
    {
        $requirement = WebsiteRequirement::findOrFail($id);
        return view('admin.web_requirement.edit', compact('requirement'));
    }
}
