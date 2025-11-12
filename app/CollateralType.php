<?php

namespace App;

enum CollateralType: string
{
    case REAL_ESTATE = 'real_estate';
    case EQUIPMENT = 'equipment';
    case INVENTORY = 'inventory';
    case ACCOUNTS_RECEIVABLE = 'accounts_receivable';
    case VEHICLES = 'vehicles';
    case MIXED_ASSETS = 'mixed_assets';
    case UNSECURED = 'unsecured';
}
