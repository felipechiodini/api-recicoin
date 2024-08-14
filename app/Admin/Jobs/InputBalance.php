<?php

namespace App\Admin\Jobs;

use App\Models\User;
use App\Models\UserCollect;
use App\Models\UserTransaction;
use App\Modules\Transaction\Type;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InputBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $userCollect;
    private $value;

    public function __construct(User $user, UserCollect $userCollect, float|int $value)
    {
        $this->user = $user;
        $this->userCollect = $userCollect;
        $this->value = $value;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->user->update(['balance' => $this->user->balance + $this->value]);

        UserTransaction::query()
            ->create([
                'user_id' => $this->user->id,
                'type' => Type::Input,
                'amount' => $this->value,
                'description' => "Referente a coleta número: {$this->userCollect->id}",
            ]);

        DB::commit();
    }
}
