<?php

namespace App\Modules\Collect;

enum Status: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Collected = 'collected';

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string {
        return match ($value) {
            self::Pending => 'Pendente',
            self::Accepted => 'Aceito',
            self::Rejected => 'Rejeitado',
            self::Collected => 'Coletado',
        };
    }
}
