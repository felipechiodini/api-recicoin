<?php

namespace App\Modules\Address;

use App\Models\User;
use App\Models\UserAddress;

class AddressRepository
{
    public function create(User $user, array $data): UserAddress
    {
        return UserAddress::query()
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
