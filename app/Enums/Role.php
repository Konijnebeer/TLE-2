<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case USER = 'user';
    case INACTIVE = 'inactive';
}
