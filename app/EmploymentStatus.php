<?php

namespace App;

enum EmploymentStatus: string
{
    case EMPLOYED = 'employed';
    case SELF_EMPLOYED = 'self_employed';
    case RETIRED = 'retired';
    case UNEMPLOYED = 'unemployed';
}
