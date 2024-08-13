<?php

namespace App\Http\Controllers;

use App\Models\CollectAddress;
use App\Models\CollectHistory;
use App\Models\UserAddress;
use App\Models\UserCollect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestCollectController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'address_id' => ['required'],
        ]);

        $userAddress = UserAddress::query()
            ->where('id', request('address_id'))
            ->first();

        DB::beginTransaction();

        $collect = UserCollect::query()
            ->create([
                'user_id' => $request->user()->id,
                'status' => 'pending'
            ]);

        CollectAddress::query()
            ->create([
                'collect_id' => $collect->id,
                'cep' => $userAddress->cep,
                'street' => $userAddress->street
            ]);

        CollectHistory::query()
            ->create([
                'collect_id' => $collect->id,
                'type' => 'request',
                'description' => 'Solicitação de coleta',
            ]);

        DB::commit();

        $message = 'Sua solicitação de coleta foi enviada com sucesso!';

        return response()
            ->json(compact('message', 'collect'));
    }
}
