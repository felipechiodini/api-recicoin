<?php

namespace App\Modules\Collect;

use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Support\Collection;

class CollectRepository
{

    public function getAllTransactions(User $user): Collection
    {
        return UserTransaction::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
