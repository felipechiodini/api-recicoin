<?php

namespace App\Modules\Address;

use App\Modules\Cep\Cep;

class Address
{
    public ?Cep $cep;
    public ?String $id;
    public ?String $street;

    public function __construct(?int $id = null, ?Cep $cep = null, ?String $street = null)
    {
        $this->id = $id;
        $this->cep = $cep;
        $this->street = $street;
    }
}
