<?php

namespace App\User\Controllers;

use App\Models\UserWhithdrawRequest;
use Illuminate\Http\Request;

class RequestWhithdrawController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'amount' => ['required'],
        ]);

        UserWhithdrawRequest::query()
            ->create([
                'user_id' => $request->user()->id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);

        $message = 'Sua solicitação de retirada foi enviada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
