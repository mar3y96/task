<?php

namespace App\Http\Controllers\Api\Tenant\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\AuthRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {

        $guard = $request->guard;
        if ($guard != 'admin' && $guard != 'user') {

            abort(404);
        }
        if ($guard == 'admin') {

            $user = Admin::where('email', $request->email)->first();
        } elseif ($guard == 'user') {

            $user = User::where('email', $request->email)->first();
        }
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }
}
