<?php

namespace App\Modules\Cep;

use Felipechiodini\Helpers\Helpers;

class Cep
{
    public String $value;

    public function __construct(String $value)
    {
        $this->value = Helpers::clearAllIsNotNumber($value);
    }

    public function __toString()
    {
        return $this->value;
    }
}
