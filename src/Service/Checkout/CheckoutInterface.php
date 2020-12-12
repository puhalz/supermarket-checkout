<?php
declare(strict_types=1);

namespace App\Service\Checkout;

use App\Collection\CartCollection;
use App\Collection\PriceListCollection;

interface CheckoutInterface
{
    public function processCart(CartCollection $cartCollection): PriceListCollection;
}
