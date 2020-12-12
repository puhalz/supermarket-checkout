<?php
declare(strict_types=1);

namespace App\Service\Checkout;

use App\Collection\CartCollection;
use App\Collection\PriceListCollection;
use App\Model\CartItem;
use App\Model\PriceList;
use App\Service\PriceCalculator\ItemPriceCalculatorInterface;

class Checkout implements CheckoutInterface
{
    private $priceCalculatorService;

    public function __construct(ItemPriceCalculatorInterface $priceCalculatorService)
    {
        $this->priceCalculatorService = $priceCalculatorService;
    }

    public function processCart(CartCollection $cartCollection): PriceListCollection
    {
        $priceList = new PriceListCollection();

        /** @var $cartItem CartItem */
        foreach ($cartCollection->getIterator() as $cartItem) {
            $priceList->add(
                new PriceList(
                    $cartItem->getItem(),
                    $cartItem->getNoOfItems(),
                    $this->priceCalculatorService->calculatePrice($cartItem, $cartCollection)
                )
            );
        }

        return $priceList;
    }
}