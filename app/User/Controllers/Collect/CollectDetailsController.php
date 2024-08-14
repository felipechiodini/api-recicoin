<?php

namespace App\User\Controllers\Collect;

use App\Models\CollectAddress;
use App\Models\CollectHistory;
use App\Models\UserCollect;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CollectDetailsController
{
    public function __invoke(UserCollect $userCollect, Request $request)
    {
        $histories = CollectHistory::query()
            ->where('collect_id', $userCollect->id)
            ->get();

        $address = CollectAddress::query()
            ->where('collect_id', $userCollect->id)
            ->first();

        $collect = [
            'id' => $userCollect->id,
            'status' => $userCollect->status,
            'histories' => $histories,
            'requested_at' => Carbon::parse($userCollect->created_at)->format('d/m/Y H:i:s'),
            'address' => $address
        ];

        return response()
            ->json(compact('collect'));
    }
}
