<?php

namespace App\Console\Commands;

use App\Admin\Jobs\InputBalance;
use App\Models\Collect as ModelsCollect;
use App\Models\CollectAddress;
use App\Models\User as ModelsUser;
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
        InputBalance::dispatch(ModelsUser::find(1), UserCollect::find(1), 1000);
    }
}
