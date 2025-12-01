<?php

namespace App\Enums;

enum GroupRole: string
{/**/
    case OWNER = 'owner';
    case MEMBER = 'member';
    case GUEST = 'guest';
}
