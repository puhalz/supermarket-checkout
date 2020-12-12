<?php
declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Model\CartItem;

interface ItemPriceCalculatorInterface
{
    public function calculatePrice(CartItem $cartItem, CartCollection $cartCollection):float;
}