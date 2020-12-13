<?php

namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Service\PriceCalculator\ItemPriceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ItemsWithNoOfferTest extends TestCase
{
    private $cartCollection;
    private $cartItem;
    private $itemPriceCalculatorService;
    private $item;

    public function setUp(): void
    {
        parent::setUp();

        $this->item = \Mockery::mock(Item::class);

        $this->cartCollection = \Mockery::mock(CartCollection::class);

        $this->cartItem = \Mockery::mock(CartItem::class);
        $this->cartItem->shouldReceive('getItem')
            ->andReturn($this->item)
            ->getMock();

        $this->itemPriceCalculatorService = new ItemPriceCalculator(
            \Mockery::mock(LoggerInterface::class)->shouldReceive('errror')->getMock()
        );
    }

    public function testItCanCalculateCorrectPriceForItemE()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('E')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(5)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(25, $price);
    }
}