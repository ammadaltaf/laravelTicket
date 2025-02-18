<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponses;
use App\Models\User;
class AuthController extends Controller
{
    use ApiResponses;
    public function register(Request $request)
    {
        // Validate request
        // $validated = $request->validated();

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token
        $token = $user->createToken('API token for '.$user->email)->plainTextToken;

        return $this->ok('User registered successfully', [
            'user' => $user,
            'token' => $token
        ]);
    }
    public function login(LoginUserRequest $request){
        $request->validated($request->all());
        if(!Auth::attempt($request->only('email','password'))){
            return $this->error('invalid credentials',401);
        }
        $user = User::firstWhere('email',$request->email);
        return $this->ok(
            'Authenticated',
            [
                'token'=> $user->createToken('API token for '.$request->email)->plainTextToken
            ]
        );
    }
}
