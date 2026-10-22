<?php

namespace App\Enum;

enum RoleUser: string
{
    case Admin = 'ROLE_ADMIN';
    case Member = 'ROLE_MEMBER';
    case User = 'ROLE_USER';
}
