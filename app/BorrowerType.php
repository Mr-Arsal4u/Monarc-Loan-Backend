<?php

namespace App;

enum BorrowerType: string
{
    case PRIMARY = 'primary';
    case CO_BORROWER = 'co_borrower';
}
