<?php

namespace App;

enum EntityType: string
{
    case INDIVIDUAL = 'individual';
    case GOVT_ENTITY = 'govt_entity';
    case TRUST = 'trust';
    case CORPORATION = 'corporation';
    case LLC = 'llc';
    case PARTNERSHIP = 'partnership';
    case LIMITED_PARTNERSHIP = 'limited_partnership';
    case NONPROFIT = 'nonprofit';
    case OTHER = 'other';
}
