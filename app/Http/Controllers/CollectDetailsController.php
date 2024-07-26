<?php

namespace App\Http\Controllers;

use App\Models\UserCollect;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class CollectDetailsController extends Controller
{

    public function __invoke(Request $request)
    {
        $collect = UserCollect::query()
            ->create([
                'user_id' => $request->user()->id,
                'status' => 'pending'
            ]);

        $message = 'Sua solicitação de coleta foi enviada com sucesso!';

        return response()
            ->json(compact('message', 'collect'));
    }

}
