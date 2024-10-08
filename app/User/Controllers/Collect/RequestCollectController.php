<?php

namespace App\User\Controllers\Collect;

use App\Models\CollectAddress;
use App\Models\CollectHistory;
use App\Models\UserAddress;
use App\Models\UserCollect;
use App\Modules\Collect\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestCollectController
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
                'status' => Status::Pending
            ]);

        CollectAddress::query()
            ->create([
                'collect_id' => $collect->id,
                'cep' => $userAddress->cep,
                'street' => $userAddress->street,
                'number' => $userAddress->number,
                'city' => $userAddress->city,
                'state' => $userAddress->state,
                'complement' => $userAddress->complement,
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
