<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItemInterface;

class NoOfferCalculator implements OfferCalculatorInterface
{
    public function calculate(CartItemInterface $cartItem, CartCollection $cartCollection):float
    {
        return $cartItem->getNoOfItems() * $cartItem->getItem()->getItemValue();
    }
}