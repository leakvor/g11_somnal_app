<?php

namespace App\Http\Controllers\Admin;
<<<<<<< HEAD

=======
>>>>>>> contact_us
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
<<<<<<< HEAD
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit', 'update']]);
=======
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit','update']]);
>>>>>>> contact_us
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $user = User::latest()->get();

        return view('setting.user.index', ['users' => $user]);
=======
        $user= User::latest()->get();

        return view('setting.user.index',['users'=>$user]);
>>>>>>> contact_us
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
<<<<<<< HEAD
        return view('setting.user.new', ['roles' => $roles]);
=======
        return view('setting.user.new',['roles'=>$roles]);
>>>>>>> contact_us
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
<<<<<<< HEAD
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        $user->syncRoles($request->roles);
        // return redirect()->back()->withSuccess('User created !!!');
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'User created successfully!'
        ]);
        return redirect()->route('admin.users.index');
=======
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User created !!!');
>>>>>>> contact_us
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = Role::get();
        $user->roles;
<<<<<<< HEAD
        return view('setting.user.edit', ['user' => $user, 'roles' => $role]);
=======
       return view('setting.user.edit',['user'=>$user,'roles' => $role]);
>>>>>>> contact_us
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
<<<<<<< HEAD
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone' => 'required',

        ]);

        if ($request->password != null) {
=======
            'name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
        ]);

        if($request->password != null){
>>>>>>> contact_us
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

<<<<<<< HEAD
        try {
            $user->update($validated);
            $user->syncRoles($request->roles);

            // Flash message using session for success
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'User updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Flash message using session for error
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Failed to update user. Please try again.'
            ]);
        }

        return redirect()->route('admin.users.index');
=======
        $user->update($validated);

        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User updated !!!');
>>>>>>> contact_us
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function destroy(User $user)
    {
        try {
            if ($user->id != 1) {
                $user->delete();

                // Flash message using session for success
                session()->flash('alert', [
                    'type' => 'success',
                    'message' => 'User deleted successfully!'
                ]);
            } else {
                session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'Admin cannot be deleted.'
                ]);
            }
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Failed to delete user. Please try again.'
            ]);
        }

        return redirect()->route('admin.users.index');
    }


=======
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withSuccess('Role deleted !!!');
    }
>>>>>>> contact_us
}
