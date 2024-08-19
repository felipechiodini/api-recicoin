<?php

namespace App\User\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class ListAddressController
{
    public function __invoke(Request $request)
    {
        $addresses = UserAddress::query()
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(function(UserAddress $userAddress) {
                return [
                    'cep' => $userAddress->cep,
                    'street' => $userAddress->street,
                    'number' => $userAddress->number,
                    'complement' => $userAddress->complement,
                    'neighborhood' => $userAddress->neighborhood,
                    'city' => $userAddress->city,
                    'state' => $userAddress->state,
                ];
            });

        return response()
            ->json(compact('addresses'));
    }
}
