<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Http\Controllers\Controller;

class SubDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subDepartments = SubDepartment::with('department')->get();
        return view('admin.sub_departments.index', compact('subDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Departments ko load kar ke view mein pass karenge
        $departments = Department::all();
        return view('admin.sub_departments.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        // SubDepartment ko create aur save karna
        SubDepartment::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
        ]);

        // Redirect karna kisi route pe (jaise index page) success message ke sath
        return redirect()->route('subDepartments.index')->with('success', 'Sub Department created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subDepartment = SubDepartment::findOrFail($id);
        $departments = Department::all();
        return view('admin.sub_departments.edit', compact('subDepartment', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = SubDepartment::findOrFail($id);
        $table->name = $request->name;
        $table->department_id = $request->department_id;
        $table->update();
        return redirect()->route('subDepartments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subDepartment = SubDepartment::find($id);
        $subDepartment->delete();
        return redirect()->back();
    }
}
