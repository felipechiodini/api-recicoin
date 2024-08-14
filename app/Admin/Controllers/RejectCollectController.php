<?php

namespace App\Admin\Controllers;

use App\Models\CollectHistory;
use App\Models\UserCollect;
use App\Modules\Collect\Status;
use Illuminate\Http\Request;

class RejectCollectController
{
    public function __invoke(UserCollect $userCollect, Request $request)
    {
        $request->validate([
            'description' => ['nullable|string'],
        ]);

        $userCollect->update(['status' => Status::Rejected]);

        CollectHistory::query()
            ->create([
                'collect_id' => $userCollect->id,
                'type' => Status::Rejected,
                'description' => $request->get('description', 'Coleta Rejeitada'),
            ]);

        $message = 'Coleta rejeitada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
