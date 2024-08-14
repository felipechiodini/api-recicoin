<?php

namespace App\Modules\Withdraw;

enum Status: string
{
    case Requested = 'requested';
    case Paid = 'paid';

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string {
        return match ($value) {
            self::Requested => 'Solicitado',
            self::Paid => 'Pago',
        };
    }
}
