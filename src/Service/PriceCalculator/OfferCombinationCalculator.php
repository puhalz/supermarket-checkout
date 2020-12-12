<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItem;

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

    public function calculate(CartItem $cartItem, CartCollection $cartCollection): float
    {
        rsort($this->offerAppliedItems);

        $offerPriceTotal = 0;
        $noOfItemEligibleForOffer = floor($cartItem->getNoOfItems() / $this->offerAppliedItems[0]);
        if ($noOfItemEligibleForOffer > 0) {
            $offerPriceTotal = $noOfItemEligibleForOffer * self::ITEM_C_3_SPECIAL_PRICE_1;
        }

        $offerPriceTotal2 = 0;
        $noOfItemsEligibleForOffer2 = floor(
            ($cartItem->getNoOfItems() % $this->offerAppliedItems[0]) / $this->offerAppliedItems[1]
        );

        if ($noOfItemsEligibleForOffer2 > 0) {
            $offerPriceTotal2 = $noOfItemsEligibleForOffer2 * self::ITEM_C_2_SPECIAL_PRICE_2;
        }

        $normalPriceTotal = 0;
        $noOfItemNotEligibleForOffer = ($cartItem->getNoOfItems() % $this->offerAppliedItems[0]) % $this->offerAppliedItems[1];
        if ($noOfItemNotEligibleForOffer > 0) {
            $normalPriceTotal = $noOfItemNotEligibleForOffer * $cartItem->getItem()->getItemValue();
        }

        return $normalPriceTotal + $offerPriceTotal + $offerPriceTotal2;
    }
}