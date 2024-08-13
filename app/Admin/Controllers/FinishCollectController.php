<?php

namespace App\Admin\Controllers;

use App\Admin\Jobs\ThrowValue;
use App\Models\CollectHistory;
use App\Models\User;
use App\Models\UserCollect;

class FinishCollectController
{
    public function __invoke(UserCollect $userCollect)
    {
        $userCollect->update([
            'status' => 2
        ]);

        CollectHistory::query()
            ->create([
                'collect_id' => $userCollect->id,
                'type' => 1,
                'description' => 'Coleta completa',
            ]);

        ThrowValue::dispatch(
            User::find($userCollect->user_id),
            $userCollect
        );

        $message = 'Coleta completada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
