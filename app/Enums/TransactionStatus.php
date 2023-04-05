<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case UNPAID = 'UNPAID';
    case PAID = 'PAID';
    case EXPIRED = 'EXPIRED';
}
