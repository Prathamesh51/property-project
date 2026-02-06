<?php

namespace App\Enums;

enum CreatedVia: string
{
    case SELF_REGISTER = 'self_register';
    case SEEDER        = 'seeder';
    case ADMIN         = 'admin';
    case IMPORT        = 'import';
}
