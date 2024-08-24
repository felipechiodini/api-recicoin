<?php

namespace App\User\Controllers;

use App\Models\UserAddress;
use Felipechiodini\Helpers\Helpers;
use Illuminate\Http\Request;

class CreateAddressController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'cep' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
            'complement' => ['nullable'],
            'neighborhood' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ]);

        $address = UserAddress::query()
            ->create([
                'user_id' => $request->user()->id,
                'cep' => Helpers::clearAllIsNotNumber($request->cep),
                'street' => $request->street,
                'number' => $request->number,
                'complement' => $request->complement,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => $request->state
            ]);

        $message = 'Endereço criado com sucesso!';

        return response()
            ->json(compact('message', 'address'));
    }
}
