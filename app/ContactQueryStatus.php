<?php

namespace App;

enum ContactQueryStatus: string
{
    case NEW = 'new';
    case READ = 'read';
    case ARCHIVED = 'archived';
}
