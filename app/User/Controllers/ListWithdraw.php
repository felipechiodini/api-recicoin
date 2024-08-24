<?php

namespace App\User\Controllers;

use App\Models\UserWithdrawRequest;
use App\Modules\Withdraw\Status;
use Carbon\Carbon;
use Felipechiodini\Helpers\Helpers;
use Illuminate\Http\Request;

class ListWithdraw
{
    public function __invoke(Request $request)
    {
        $withdraws = UserWithdrawRequest::query()
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(function(UserWithdrawRequest $userWithdrawRequest) {
                return [
                    'status' => Status::from($userWithdrawRequest->status)->label(),
                    'value' => Helpers::formatCurrency($userWithdrawRequest->value),
                    'requested_at' => Carbon::parse($userWithdrawRequest->created_at)->format('d/m/Y H:i:s'),
                ];
            });

        return response()
            ->json(compact('withdraws'));
    }
}
