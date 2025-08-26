<?php

namespace App\Enums;

enum LogTypeEnum: string
{
    case INFO = 'info';
    case ALERT = 'alert';
    case EMERGENCY = 'emergency';
}
