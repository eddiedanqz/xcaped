<?php

namespace App\Enums;

enum TicketStatus: string
{
    case CLOSED = 'closed';
    case OPEN = 'open';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
