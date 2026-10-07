<?php

namespace App\Entity\Enum;

enum CartPaymentMethod: string
{
    case VOUCHER = 'voucher';
    case CARD= 'card';
}
