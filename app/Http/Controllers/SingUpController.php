<?php

namespace App\Http\Controllers;

use App\Models\User;
use Felipechiodini\Cpf\Cpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SingUpController extends Controller
{

    public function singup(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'cellphone' => ['required', 'string', 'max:255'],
        ]);

        $user = User::query()
            ->create([
                'name' => $request->name,
                'email' => Str::lower($request->email),
                'password' => Hash::make($request->password),
                'cellphone' => Str::dddd($request->cellphone)
            ]);

        return response()
            ->json(compact('user'));
    }

}
