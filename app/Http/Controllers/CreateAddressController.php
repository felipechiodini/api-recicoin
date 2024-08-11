<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateAddressController extends Controller
{
    public function __invoke(Request $request)
    {
        $repository = new \App\Modules\Address\AddressRepository();
        $address = $repository->create($request->user(), $request->all());

        $message = 'Endereço criado com sucesso!';

        return response()
            ->json(compact('message', 'address'));
    }
}
