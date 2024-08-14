<?php

namespace App\User\Controllers;

use App\Models\UserWithdrawRequest;
use App\Modules\Withdraw\Status;
use Illuminate\Http\Request;

class RequestWithdrawController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'value' => ['required'],
        ]);

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
