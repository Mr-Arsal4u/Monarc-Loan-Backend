<?php

namespace App;

enum LoanPurpose: string
{
    case PURCHASE_REMODEL_SELL = 'purchase-remodel-sell';
    case REFINANCE_REMODEL_SELL = 'refinance-remodel-sell';
    case RENTAL_INCOME = 'rental-income';
    case CONSTRUCTION = 'construction';
}
