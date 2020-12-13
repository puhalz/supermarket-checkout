<?php

declare(strict_types=1);

namespace App\Util;

class Math
{
    public static function getQuotientAndReminder($noOfItemsInCart, $offerApplicableItems)
    {
        if (0 === (int)$offerApplicableItems) {
            throw new \InvalidArgumentException(
                'offerApplicableItems cannot be Zero, else the Item has to be part of No offer Group'
            );
        }

        return [
            'quotient' => (int)\intdiv($noOfItemsInCart, $offerApplicableItems),
            'reminder' => (int)$noOfItemsInCart % $offerApplicableItems
        ];
    }
}
