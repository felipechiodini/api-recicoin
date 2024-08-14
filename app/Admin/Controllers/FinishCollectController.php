<?php

namespace App\Admin\Controllers;

use App\Admin\Jobs\InputBalance;
use App\Models\CollectHistory;
use App\Models\User;
use App\Models\UserCollect;
use App\Modules\Collect\Status;

class FinishCollectController
{
    public function __invoke(UserCollect $userCollect)
    {
        $userCollect->update(['status' => Status::Collected]);

        CollectHistory::query()
            ->create([
                'collect_id' => $userCollect->id,
                'type' => Status::Collected,
                'description' => 'Coleta completa',
            ]);

        InputBalance::dispatch(
            User::find($userCollect->user_id),
            $userCollect
        );

        $message = 'Coleta completada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
