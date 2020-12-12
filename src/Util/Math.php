<?php

declare(strict_types=1);

namespace App\Util;

class Math
{
    public static function getQuotientAndReminder($noOfItemsInCart, $offerApplicableItems)
    {
        /**
         * gmp_div_qr — Divide numbers and get quotient and remainder
         */
        $CheckItemsEligibleForOffer = gmp_div_qr(
            $noOfItemsInCart,
            $offerApplicableItems
        );

        return [
            (int)gmp_strval($CheckItemsEligibleForOffer[0]),
            (int)gmp_strval($CheckItemsEligibleForOffer[1])
        ];
    }
}
