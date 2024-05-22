<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponses;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->all();
        $request->validated($credentials);


        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok('Authenticated', [
            'token' => $user->createToken(
                'Api Token for ' . $user->email,
                ['*'],
                now()->addMonth()
            )->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        // return $request->user()->tokens()->delete();
        // return $request->user()->tokens()->where('id', $tokenId)->delete();
        $request->user()->currentAccessToken()->delete();
        return $this->ok('');
    }
}
