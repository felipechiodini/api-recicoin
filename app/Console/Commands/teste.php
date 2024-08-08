<?php

namespace App\Console\Commands;

use App\Models\Collect as ModelsCollect;
use App\Models\CollectAddress;
use App\Models\UserAddress;
use App\Models\UserCollect;
use App\Modules\Address\Address;
use App\Modules\Collect\Collect;
use App\Modules\User\User;
use Illuminate\Console\Command;

class teste extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:teste';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = UserAddress::query()
            ->where('id', 1)
            ->first();

        $collect = (new Collect())
            ->setUser(new User(1))
            ->setAddress(new Address(1));

        $model = UserCollect::query()
            ->create([
                'user_id' => $collect->user->id,
                'status' => $collect->status
            ]);

        CollectAddress::query()
            ->create([
                'collect_id' => $model->id,
                'cep' => $collect->address->cep,
                'street' => $collect->address->street
            ]);

        dd($d);

        //
    }
}
