<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItemInterface;
use App\Util\Math;

class OfferCombinationCalculator implements OfferCalculatorInterface
{
    const ITEM_C_OFFER_FROM_X_ITEMS_1 = 3;
    const ITEM_C_3_SPECIAL_PRICE_1 = 50;
    const ITEM_C_OFFER_FROM_X_ITEMS_2 = 2;
    const ITEM_C_2_SPECIAL_PRICE_2 = 38;

    private $offerAppliedItems = [
        self::ITEM_C_OFFER_FROM_X_ITEMS_1,
        self::ITEM_C_OFFER_FROM_X_ITEMS_2,
    ];

    public function calculate(CartItemInterface $cartItem, CartCollection $cartCollection): float
    {
        rsort($this->offerAppliedItems);

        $CheckItemsEligibleForOffer1 = Math::getQuotientAndReminder(
            $cartItem->getNoOfItems(),
            $this->offerAppliedItems[0]
        );

        $noOfItemsEligibleForOffer1 = $CheckItemsEligibleForOffer1[0];

        $noOfItemsNotEligibleForOffer1 = $CheckItemsEligibleForOffer1[1];

        $CheckItemsEligibleForOffer2 = Math::getQuotientAndReminder(
            $noOfItemsNotEligibleForOffer1,
            $this->offerAppliedItems[1]
        );

        $noOfItemsEligibleForOffer2 = $CheckItemsEligibleForOffer2[0];

        $noOfItemsNotEligibleForOffer2 = $CheckItemsEligibleForOffer2[1];

        return ($noOfItemsEligibleForOffer1 * self::ITEM_C_3_SPECIAL_PRICE_1) +
             ($noOfItemsEligibleForOffer2 * self::ITEM_C_2_SPECIAL_PRICE_2) +
            ($noOfItemsNotEligibleForOffer2 * $cartItem->getItem()->getItemValue());
    }
}
