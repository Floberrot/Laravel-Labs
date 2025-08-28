<?php

namespace App\Enums;

enum LogTypeEnum: string
{
    case INFO = 'info';
    case ALERT = 'alert';
    case EMERGENCY = 'emergency';

    public function color(): string
    {
        return match ($this) {
            self::INFO => 'yellow',
            self::EMERGENCY => 'red',
            self::ALERT => 'orange'
        };
    }
}
