<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItemInterface;

interface OfferCalculatorInterface
{
    public function calculate(CartItemInterface $cartItem, CartCollection $cartCollection):float;
}