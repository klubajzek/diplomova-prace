<?php

namespace App\Model;

use App\Traits\Enum;

enum Roles: string
{
    use Enum;
    case ROLE_ADMIN = 'Admin';
    case ROLE_USER = 'Uživatel';
}