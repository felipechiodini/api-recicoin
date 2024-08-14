<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\UserCollect;
use App\Modules\Collect\Status;

class ListCollectController
{
    public function __invoke(UserCollect $userCollect)
    {
        $collects = UserCollect::query()
            ->orderByDesc('id')
            ->get()
            ->map(function($userCollect) {
                $user = User::find($userCollect->user_id);

                return [
                    'user' => $user,
                    'status' => Status::from($userCollect->status)->label()
                ];
            });

        return response()
            ->json(compact('collects'));
    }
}
