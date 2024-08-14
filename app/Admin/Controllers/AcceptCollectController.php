<?php

namespace App\Admin\Controllers;

use App\Models\CollectHistory;
use App\Models\UserCollect;
use App\Modules\Collect\Status;

class AcceptCollectController
{
    public function __invoke(UserCollect $userCollect)
    {
        $userCollect->update(['status' => Status::Accepted]);

        CollectHistory::query()
            ->create([
                'collect_id' => $userCollect->id,
                'type' => Status::Accepted,
                'description' => 'Coleta aceita',
            ]);

        $message = 'Coleta aceita com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
