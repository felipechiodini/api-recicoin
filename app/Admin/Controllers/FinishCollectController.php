<?php

namespace App\Admin\Controllers;

use App\Admin\Jobs\InputBalance;
use App\Models\CollectHistory;
use App\Models\User;
use App\Models\UserCollect;
use App\Modules\Collect\Status;
use Illuminate\Http\Request;

class FinishCollectController
{
    public function __invoke(UserCollect $collect, Request $request)
    {
        $request->validate([
            'value' => ['required'],
        ]);

        $collect->update(['status' => Status::Collected]);

        CollectHistory::query()
            ->create([
                'collect_id' => $collect->id,
                'type' => Status::Collected,
                'description' => 'Coleta completa'
            ]);

        InputBalance::dispatch(
            User::find($collect->user_id),
            $collect,
            $request->value
        );

        $message = 'Coleta completada com sucesso!';

        return response()
            ->json(compact('message'));
    }
}
