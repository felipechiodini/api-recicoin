<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __invoke()
    {
        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = User::query()
                ->where('email', $credentials['email'])
                ->first();

            $token = $user->createToken('authToken');
        }

        return response()
            ->json([
                'token' => $token->plainTextToken
            ]);
    }

}
