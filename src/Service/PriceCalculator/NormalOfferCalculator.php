<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItemInterface;
use App\Model\Item;

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
        $offerPriceTotal = 0;
        $noOfItemEligibleForOffer = floor($cartItem->getNoOfItems() / $this->offerAppliedItems[$cartItem->getItem()->getItemName()]);
        if ($noOfItemEligibleForOffer > 0) {
            $offerPriceTotal = $noOfItemEligibleForOffer * $this->offerPrice[$cartItem->getItem()->getItemName()];
        }

        $normalPriceTotal = 0;
        $noOfItemNotEligibleForOffer = $cartItem->getNoOfItems() % $this->offerAppliedItems[$cartItem->getItem()->getItemName()];

        if ($noOfItemNotEligibleForOffer > 0) {
            $normalPriceTotal = $noOfItemNotEligibleForOffer * $cartItem->getItem()->getItemValue();
        }

        return $normalPriceTotal + $offerPriceTotal;
    }
}
