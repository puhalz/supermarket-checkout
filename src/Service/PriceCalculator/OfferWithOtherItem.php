<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\CartItemInterface;

class OfferWithOtherItem implements OfferCalculatorInterface
{
    const ITEM_D_OFFER_PURCHASED_WITH_ITEM = 'A';
    const ITEM_D_SPECIAL_PRICE = 5;

    public function calculate(CartItemInterface $cartItem, CartCollection $cartCollection): float
    {
        $itemACount = $this->getItemACount($cartCollection);

        $itemDCount = $cartItem->getNoOfItems();

        if ($itemACount >= $itemDCount) {
            return $itemDCount * self::ITEM_D_SPECIAL_PRICE;
        }

        if ($itemDCount > 0 && $itemDCount > $itemACount) {
            $offerNotApplicableItems = $itemDCount - $itemACount;

            return ($offerNotApplicableItems * $cartItem->getItem()->getItemValue()) + ($itemACount * self::ITEM_D_SPECIAL_PRICE);
        }

        return 0;
    }

    //It can be moved to collection - To get a specific Item.
    private function getItemACount(CartCollection $cartCollection): int
    {
        $itemACount = 0;

        /** @var $cartItemList CartItem */
        foreach ($cartCollection->getIterator() as $cartItemList) {
            if (self::ITEM_D_OFFER_PURCHASED_WITH_ITEM === $cartItemList->getItem()->getItemName()) {
                $itemACount = $cartItemList->getNoOfItems();
            }
        }

        return $itemACount;
    }
}
