<?php

namespace App\Admin\Controllers;

use App\Models\CollectHistory;
use App\Models\UserCollect;

class AcceptCollectController
{
    public function __invoke(UserCollect $userCollect)
    {
        $userCollect->update([
            'status' => 1
        ]);

        CollectHistory::query()
            ->create([
                'collect_id' => $userCollect->id,
                'type' => 1,
                'description' => 'Coleta aceita',
            ]);

        $message = 'Coleta aceita com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
