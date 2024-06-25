<?php

namespace App\Http\Controllers;

use App\Models\Frontuser;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
          ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user   = User::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
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
        // return $request;
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user'=> $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
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
    // return $request->user()->id;
    $validateUser = Validator::make($request->all(), [
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);
    if ($validateUser->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'validation error',
            'errors' => $validateUser->errors()
        ], 422);
    }
    $img = $request->profile;
    $ext = $img->getClientOriginalExtension();
    $imageName = time() . '.' . $ext;
    $img->move(public_path() . '/uploads/', $imageName);

    try {
        $user = $request->user();
        $user->update([
            'profile' => $imageName
        ]);
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Profile updated successfully'
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 404);
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

}
