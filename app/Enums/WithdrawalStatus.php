<?php

namespace App\Enums;

enum WithdrawalStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case SUSPENDED = 'suspended';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
