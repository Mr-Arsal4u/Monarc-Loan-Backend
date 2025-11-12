<?php

namespace App;

enum AddressType: string
{
    case CURRENT = 'current';
    case MAILING = 'mailing';
    case FORMER = 'former';
    case PRINCIPAL = 'principal';
    case COLLATERAL = 'collateral';
    case EMPLOYER = 'employer';
}
