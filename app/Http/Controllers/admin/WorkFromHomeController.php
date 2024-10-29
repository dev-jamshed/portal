<?php

namespace App\Http\Controllers\admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkFromHomePermission;

class WorkFromHomeController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
        $this->middleware('permission:view workFromHomePermission', ['only' => ['index']]);
        $this->middleware('permission:create workFromHomePermission', ['only' => ['create','store']]);
        $this->middleware('permission:update workFromHomePermission', ['only' => ['update','edit']]);
        $this->middleware('permission:delete workFromHomePermission', ['only' => ['destroy']]);
    }
   

    public function index()
    {
        $permissions = WorkFromHomePermission::with('employee')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
       $users = User::all();
      return view('admin.permissions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        WorkFromHomePermission::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
        ]);

        return redirect()->route('work_from_home.index')->with('success', 'Work from home permission created successfully.');
    }

    public function edit($id)
    {
        $permission = WorkFromHomePermission::findOrFail($id);
        $users = User::all();
        return view('admin.permissions.edit', compact('permission', 'users'));
    }
    

    public function update(Request $request, WorkFromHomePermission $permission)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
        ]);
    
        $permission->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
        ]);
    
        return redirect()->route('work_from_home.store')->with('success', 'Work from home permission updated successfully.');
    }

    public function destroy($id)
    {

        $permission   =  WorkFromHomePermission::findOrFail($id);
        $permission->delete();
        return redirect()->route('work_from_home.store')->with('success', 'Work from home permission deleted successfully.');
    }
}
