<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\UserTransaction;
use App\Models\UserWithdrawRequest;
use App\Modules\Transaction\Type;
use App\Modules\Withdraw\Status;
use Illuminate\Support\Facades\DB;

class PayWithdrawController
{
    public function __invoke(UserWithdrawRequest $userWithdrawRequest)
    {
        DB::beginTransaction();

        $userWithdrawRequest->update(['status' => Status::Paid]);

        $user = User::find($userWithdrawRequest->user_id);

        $user->update(['balance' => $user->balance - $userWithdrawRequest->value]);

        UserTransaction::query()
            ->create([
                'user_id' => $user->id,
                'type' => Type::Output,
                'amount' => $userWithdrawRequest->value,
                'description' => "Refente a retirada número: {$userWithdrawRequest->id}",
            ]);

        DB::commit();

        $message = 'Retirada concluída com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
