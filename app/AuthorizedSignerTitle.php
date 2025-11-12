<?php

namespace App;

enum AuthorizedSignerTitle: string
{
    case CEO = 'ceo';
    case PRESIDENT = 'president';
    case CFO = 'cfo';
    case FINANCE_DIRECTOR = 'finance_director';
    case OWNER = 'owner';
    case PARTNER = 'partner';
    case TREASURER = 'treasurer';
    case MANAGER = 'manager';
}
