<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class CreateAddressController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'cep' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
        ]);

        $address = UserAddress::query()
            ->create([
                'user_id' => $request->user()->id,
                'cep' => $request->cep,
                'street' => $request->street,
                'number' => $request->number
            ]);

        $message = 'Endereço criado com sucesso!';

        return response()
            ->json(compact('message', 'address'));
    }
}
