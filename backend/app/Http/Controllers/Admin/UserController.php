<?php

namespace App\Http\Controllers\Admin;
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
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(4);

        return view('setting.user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('setting.user.new', ['roles' => $roles]);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'profile' => 'file|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->move('images/profiles', $profileImageName);
            $user->profile = 'images/profiles/' . $profileImageName;
        }

        $user->save();

        // Sync roles
        $user->syncRoles($request->roles);
        // return redirect()->back()->withSuccess('User created !!!');
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'User created successfully!'
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            // 'name' => $user->name,
            // 'email' => $user->email,
            'roles' => $user->roles->pluck('name')->toArray(),
        ]);
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
        return view('setting.user.edit', ['user' => $user, 'roles' => $role]);
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone' => 'required',
            'profile' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->password != null) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }
    
        // Handle profile image upload or deletion
        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->move('images/profiles', $profileImageName);
            $validated['profile'] = 'images/profiles/' . $profileImageName;
        } elseif ($request->profile === null) { // Check if profile is explicitly set to null
            $validated['profile'] = null; // Set profile to null
        }
    
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
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


}