<?php

namespace App\Modules\Transaction;

enum Type: string
{
    case Input = 'input';
    case Output = 'output';

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string {
        return match ($value) {
            self::Input => 'Entrada',
            self::Output => 'Saída',
        };
    }
}
