<?php

namespace App\Http\Controllers;

use App\Models\UserWhithdrawRequest;
use Illuminate\Http\Request;

class RequestWhithdrawController extends Controller
{

    public function __invoke(Request $request)
    {
        UserWhithdrawRequest::query()
            ->create([
                'user_id' => $request->user()->id,
                'amount' => $request->amount
            ]);

        $message = 'Sua solicitação de saque foi enviada com sucesso!';

        return response()
            ->json(compact('message'));
    }

}
