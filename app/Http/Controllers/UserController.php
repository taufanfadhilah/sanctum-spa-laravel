<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        
        return response()->json([
            'success' => true,
            'message' => 'register success',
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => false,
                'message' => 'login failed',
                'data' => null
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    }
}
