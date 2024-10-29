<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view deparment', ['only' => ['index']]);
        $this->middleware('permission:create deparment', ['only' => ['create', 'store']]);
        $this->middleware('permission:update deparment', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete deparment', ['only' => ['destroy']]);
    }

    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Department();
        $table->name = $request->name;
        $table->save();
        return redirect()->route('departments.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Department::findOrFail($id);

        $table->name = $request->name;
        $table->update();
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->back();
    }


    public function getSubDepartments($departmentId)
    {
        $subDepartments = SubDepartment::where('department_id', $departmentId)->get();
        return response()->json($subDepartments);
    }
}
