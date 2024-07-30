<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Cpf as RulesCpf;
use Felipechiodini\Cpf\Cpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SingUpController extends Controller
{

    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'cellphone' => ['required', 'string', 'max:255'],
            'document' => ['required', new RulesCpf, 'unique:users'],
        ]);

        $user = User::query()
            ->create([
                'name' => $request->name,
                'document' => new Cpf($request->document),
                'cellphone' => $request->cellphone,
                'email' => Str::lower($request->email),
                'password' => Hash::make($request->password)
            ]);

        return response()
            ->json(compact('user'));
    }

}
