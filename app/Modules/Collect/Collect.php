<?php

namespace App\Modules\Collect;

use App\Modules\Address\Address;
use App\Modules\User\User;

class Collect
{
    public User $user;
    public Address $address;
    public String $status = 'pending';

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }
}
