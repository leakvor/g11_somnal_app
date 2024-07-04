<?php

namespace App\Http\Controllers;

use App\Models\Frontuser;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{ 
    public function login(Request $request): JsonResponse
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string'
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Please chack you email or password again'], 401);
        }

        // Retrieve the authenticated user
        $user = Auth::user();

        // Generate a plain text token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Create a cookie with the user details
        $userCookie = Cookie::make('user', json_encode($user), 60);

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'user'          => $user
        ])->withCookie($userCookie);
    }
    
    public function index(Request $request)
    {
        $user = $request->user();
        // $permissions = $user->getAllPermissions();
        // $roles = $user->getRoleNames();
        return response()->json([
            'message' => 'Login success',
            'data' =>$user,
        ]);
    }

    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8',
                ]
            );
    
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 422);
            }
    
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile'=>'1719900794.png',
                'role_id' => 2,
                
            ]);
    
    
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $user->createToken("API_TOKEN")->plainTextToken
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function company_register(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                ]
            );
    
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 422); // Changed HTTP status code to 422 Unprocessable Entity
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $user->createToken("API_TOKEN")->plainTextToken
            ], 201); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500); // Internal Server Error for unexpected exceptions
        }
    }
    
//logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Logout failed. Please try again.'], 500);
        }
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    
    public function uploadProfile(Request $request)
    {
        try {
            $user = $request->user();
    
            // Update user attributes based on validated input
            if ($request->has('name')) {
                $user->name = $request->name;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }
            if ($request->has('phone')) {
                $user->phone = $request->phone;
            }
            if ($request->has('role_id')) {
                $user->role_id = $request->role_id;
            }
    
            if ($request->hasFile('profile')) {
                $img = $request->file('profile');
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $img->move(public_path('uploads'), $imageName);
                $user->profile = $imageName;
            }
    
            $user->save();
    
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Profile updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    
// forgot password
public function forgotPassword(Request $request): JsonResponse
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $token = Str::random(60);
    
        Password::create([
            'email' => $user->email,
            'token' => $token,
            'expires_at' => now()->addHours(1), // Example: Token expires in 1 hour
        ]);
        return response()->json(['message' => 'Password reset link sent to your email','tokend' => $token]);
    }

    //reset password======
    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $passwordReset = Password::where('email', $request->email)
            ->where('token', $request->token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $passwordReset->delete(); 

        return response()->json(['message' => 'Password reset successfully']);
    }

    //check email unique============
    public function checkEmailUnique(Request $request)
{
    $email = $request->email;

    $isUnique = !User::where('email', $email)->exists();

    return response()->json(['unique' => $isUnique, 'message' => $isUnique ? 'Email is available' : 'Email already exists']);
}
  

}
