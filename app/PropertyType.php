<?php

namespace App;

enum PropertyType: string
{
    case SINGLE_FAMILY = 'single_family';
    case CONDO = 'condo';
    case TOWNHOUSE = 'townhouse';
    case MULTI_FAMILY = 'multi_family';
}
