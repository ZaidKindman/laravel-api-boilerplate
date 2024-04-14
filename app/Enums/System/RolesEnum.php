<?php

namespace App\Enums\System;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case AUTHOR = 'author';
    case SUPER_ADMIN = 'super-admin';
}
