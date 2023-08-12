<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json([
        //     'message' => 'Login success',
        //     'access_token' => $token,
        //     'token_type' => 'Bearer'
        // ]);

        return redirect('/dashboard')->with([
            'access_token' => $token,
            'user' => $user
        ]);
    }
}
