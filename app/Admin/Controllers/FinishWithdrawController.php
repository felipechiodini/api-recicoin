<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\UserTransaction;
use App\Models\UserWithdrawRequest;
use Illuminate\Support\Facades\DB;

class FinishWithdrawController
{
    public function __invoke(UserWithdrawRequest $userWithdrawRequest)
    {
        DB::beginTransaction();

        $userWithdrawRequest->update(['status' => 2]);

        $user = User::find($userWithdrawRequest->user_id);

        $user->update(['balance' => $user->balance - $userWithdrawRequest->value]);

        UserTransaction::query()
            ->create([
                'user_id' => $user->id,
                'type' => 1,
                'amount' => $userWithdrawRequest->value,
                'description' => "Refente a retirada numero: {$userWithdrawRequest->id}",
            ]);

        DB::commit();

        $message = 'Retirada concluída com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
