<?php

namespace App;

enum OwnershipShare: string
{
    case LESS_THAN_25 = 'less_than_25';
    case TWENTY_FIVE_OR_MORE = '25_or_more';
}
