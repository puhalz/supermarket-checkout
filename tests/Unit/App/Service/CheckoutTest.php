<?php

namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Collection\PriceListCollection;
use App\Model\CartItem;
use App\Model\Item as ItemModel;
use App\Service\Checkout\Checkout;
use App\Service\PriceCalculator\ItemPriceCalculatorInterface;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    private $checkoutService;

    public function setUp()
    {
        parent::setUp();

        $this->checkoutService = new Checkout(
            \Mockery::mock(ItemPriceCalculatorInterface::class)
                ->shouldReceive('calculatePrice')
                ->andReturn(20)->getMock()
        );
    }

    public function testItCanProcessCartAndReturnPriceListCollection()
    {
        $addCart1 = new CartItem(new ItemModel('A', 50), 7);
        $addCart2 = new CartItem(new ItemModel('B', 30), 3);
        $addCart3 = new CartItem(new ItemModel('C', 20), 7);
        $addCart4 = new CartItem(new ItemModel('D', 15), 8);
        $addCart5 = new CartItem(new ItemModel('E', 5), 5);

        $response = $this->checkoutService->processCart(
            new CartCollection([$addCart1, $addCart2, $addCart3, $addCart4, $addCart5])
        );

        $this->assertInstanceOf(PriceListCollection::class, $response);
    }
}