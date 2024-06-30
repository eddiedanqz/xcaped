<?php

namespace App\Enums;

enum EventStatus: string
{
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case PAST = 'past';
    case SUSPENDED = 'suspended';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
