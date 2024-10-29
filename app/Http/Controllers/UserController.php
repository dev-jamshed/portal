<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SubDepartment;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {


        return view('users.index', [
            'users' => User::latest('id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $schedules =  Schedule::get();
        $roles = Role::pluck('name')->all();
        $departments = Department::all();
        $subDepartment = SubDepartment::all();
        return view('users.create', compact('roles', 'schedules', 'departments', 'subDepartment'));
    }


    public function store(Request  $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required',
            'roles' => 'required'
        ];

        if (in_array('Employee', $request->roles)) {
            $rules['department_id'] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }



        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->schedule_id = $request->schedule_id;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        $user->color_code = $this->generateLightColor();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_pic/'), $imageName);
            $user->pic = 'uploads/profile_pic/' . $imageName;
        }
        if (in_array('Employee', $request->roles)) {
            $user->department_id = $request->department_id;
            $user->sub_department_id = $request->sub_department_id;
            $user->position = $request->position;
        }
        $user->save();
        $user->syncRoles($request->roles);
        return redirect()->route('users.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        // if ($user->hasRole('super-admin')) {
        //     if ($user->id != auth()->user()->id) {
        //         abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        //     }
        // }
        $schedules =  Schedule::get();
        $departments = Department::all();
        $subDepartment = SubDepartment::all();

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all(),
            'schedules' => $schedules,
            'departments' => $departments,
            'subDepartment' => $subDepartment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return  $request->color_code;
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|numeric',
            'password' => 'nullable',
            'roles' => 'required',
            'color_code ' => 'nullable|string|max:7', // Add color validation
        ];

        if (in_array('Employee', $request->roles)) {
            $rules['department_id'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        // if (is_null($user->color_code)) {
        //     $user->color_code = $this->generateLightColor();
        // }
       
        $user->name = $request->name;
        $user->email = $request->email;
        $user->schedule_id = $request->schedule_id;
        $user->phone = $request->phone;
        info($request->color_code);
        $user->color_code = $request->color_code;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_pic/'), $imageName);
            $user->pic = 'uploads/profile_pic/' . $imageName;
        }

        if (in_array('Employee', $request->roles)) {
            $user->department_id = $request->department_id;
            $user->sub_department_id = $request->sub_department_id;
            $user->position = $request->position;
        } else {
            $user->department_id = null;
            $user->sub_department_id = null;
            $user->position = null;
        }

        $user->save();
        $user->syncRoles($request->roles);

        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess('User is deleted successfully.');
    }

    // Random light color generate karne ka function
    private function generateLightColor(): string
    {
        $red = rand(200, 255);
        $green = rand(200, 255);
        $blue = rand(200, 255);
        return sprintf("#%02x%02x%02x", $red, $green, $blue);
    }
}
