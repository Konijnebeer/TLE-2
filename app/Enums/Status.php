<?php

namespace App\Enums;

enum Status: string
{
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
}
