<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItemInterface;
use App\Model\Item;
use App\Util\Math;

class NormalOfferCalculator implements OfferCalculatorInterface
{
    const ITEM_A_OFFER_FROM_X_ITEMS = 3;
    const ITEM_A_3_SPECIAL_PRICE = 130;

    const ITEM_B_OFFER_FROM_X_ITEMS = 2;
    const ITEM_B_2_SPECIAL_PRICE = 45;

    private $offerAppliedItems = [
        Item::ITEM_A => self::ITEM_A_OFFER_FROM_X_ITEMS,
        Item::ITEM_B => self::ITEM_B_OFFER_FROM_X_ITEMS,
    ];

    private $offerPrice = [
        Item::ITEM_A => self::ITEM_A_3_SPECIAL_PRICE,
        Item::ITEM_B => self::ITEM_B_2_SPECIAL_PRICE
    ];

    public function calculate(CartItemInterface $cartItem, CartCollection $cartCollection): float
    {
        $CheckItemsEligibleForOffer = Math::getQuotientAndReminder(
            $cartItem->getNoOfItems(),
            $this->offerAppliedItems[$cartItem->getItem()->getItemName()]
        );

        $noOfItemsEligibleForOffer = $CheckItemsEligibleForOffer[0];

        $noOfItemsNotEligibleForOffer = $CheckItemsEligibleForOffer[1];

        return ($noOfItemsEligibleForOffer * $this->offerPrice[$cartItem->getItem()->getItemName()])
            + ($noOfItemsNotEligibleForOffer * $cartItem->getItem()->getItemValue());
    }
}
