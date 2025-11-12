<?php

namespace App;

enum Citizenship: string
{
    case US_CITIZEN = 'us_citizen';
    case PERMANENT_RESIDENT = 'permanent_resident';
    case NON_PERMANENT_RESIDENT = 'non_permanent_resident';
}
