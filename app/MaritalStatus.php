<?php

namespace App;

enum MaritalStatus: string
{
    case MARRIED = 'married';
    case SEPARATED = 'separated';
    case UNMARRIED = 'unmarried';
}
