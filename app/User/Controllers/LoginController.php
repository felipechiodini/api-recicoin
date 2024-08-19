<?php

namespace App\User\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::query()
            ->where('email', $credentials['email'])
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        $addresses = UserAddress::query()
            ->get('cep', 'street', 'number', 'complement', 'neighborhood', 'city', 'state')
            ->map(function(UserAddress $userAddress) {
                return [
                    'cep' => $userAddress->cep,
                    'street' => $userAddress->street,
                    'number' => $userAddress->number,
                    'complement' => $userAddress->complement,
                    'neighborhood' => $userAddress->neighborhood,
                    'city' => $userAddress->city,
                    'state' => $userAddress->state
                ];
            });

        return response()
            ->json(compact('user', 'token', 'addresses'));
    }
}
