<?php

namespace App;

enum LoanStatus: string
{
    case DRAFT = 'draft';
    case IN_PROGRESS = 'in_progress';
    case SUBMITTED = 'submitted';
    case UNDER_REVIEW = 'under_review';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case WITHDRAWN = 'withdrawn';
}
