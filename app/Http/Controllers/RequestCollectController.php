<?php

namespace App\Http\Controllers;

use App\Models\CollectAddress;
use App\Models\CollectHistory;
use App\Models\UserAddress;
use App\Models\UserCollect;
use App\Modules\Address\Address;
use App\Modules\Cep\Cep;
use App\Modules\Collect\Collect;
use App\Modules\User\User;
use Illuminate\Http\Request;

class RequestCollectController extends Controller
{

    public function __invoke(Request $request)
    {
        $request->validate([
            'address_id' => ['required'],
        ]);

        $collect = (new Collect())
            ->setUser($this->makeUser())
            ->setAddress($this->makeAddress());

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

        CollectHistory::query()
            ->create([
                'collect_id' => $model->id,
                'type' => 'request',
                'description' => 'Solicitação de coleta',
            ]);

        $message = 'Sua solicitação de coleta foi enviada com sucesso!';

        return response()
            ->json(compact('message', 'collect'));
    }

    private function makeUser(): User
    {
        $user = auth()->user();

        return new User($user->id);
    }

    private function makeAddress(): Address
    {
        $model = UserAddress::query()
            ->where('id', request('address_id'))
            ->first();

        return new Address(
            $model->id,
            new Cep($model->cep),
            $model->street,
            $model->number,
        );
    }

}
