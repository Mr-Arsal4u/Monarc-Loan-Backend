<?php

namespace App;

enum NoteVisibility: string
{
    case INTERNAL = 'internal';
    case BORROWER_VISIBLE = 'borrower_visible';
}
