<?php

namespace App\User\Controllers;

use App\Models\UserWithdrawRequest;
use App\Modules\Withdraw\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RequestWithdrawController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'value' => ['required'],
        ]);

        if ($request->value < 5) {
            throw ValidationException::withMessages([
                'value' => 'O valor mínimo da retirada é de 5 reais!'
            ]);
        }

        if ($request->value > $request->user()->balance) {
            throw ValidationException::withMessages([
                'value' => 'Saldo insuficiente!'
            ]);
        }

        UserWithdrawRequest::query()
            ->create([
                'user_id' => $request->user()->id,
                'value' => $request->value,
                'status' => Status::Requested
            ]);

        $message = 'Sua solicitação de retirada foi enviada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
