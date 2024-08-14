<?php

namespace App\User\Controllers\Collect;

use App\Models\CollectAddress;
use App\Models\UserCollect;
use App\Modules\Collect\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CollectListController
{
    public function __invoke(Request $request)
    {
        $collects = UserCollect::query()
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(function(UserCollect $collect) {
                $address = CollectAddress::query()
                    ->select('cep', 'street', 'number', 'city', 'state', 'complement')
                    ->where('collect_id', $collect->id)
                    ->first();

                return [
                    'id' => $collect->id,
                    'status' => Status::from($collect->status)->label(),
                    'requested_at' => Carbon::parse($collect->created_at)->format('d/m/Y H:i:s'),
                    'address' => $address
                ];
            });

        return response()
            ->json(compact('collects'));
    }
}
