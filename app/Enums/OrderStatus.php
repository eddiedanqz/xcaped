<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case REFUNDED = 'refunded';
    case PENDING = 'pending';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
