<?php

namespace App\Admin\Jobs;

use App\Models\User;
use App\Models\UserCollect;
use App\Models\UserTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ThrowValue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $userCollect;

    public function __construct(User $user, UserCollect $userCollect)
    {
        $this->user = $user;
        $this->userCollect = $userCollect;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->user->update([
            'balance' => $this->user->balance + $this->userCollect->value
        ]);

        UserTransaction::query()
            ->create([
                'user_id' => $this->user->id,
                'type' => 1,
                'amount' => $this->userCollect->value,
                'description' => "Refente a coleta numero: {$this->userCollect->id}",
            ]);

        DB::commit();
    }
}
