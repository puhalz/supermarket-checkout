<?php

namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Service\PriceCalculator\ItemPriceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ItemWithOneOfferTest extends TestCase
{
    private $cartCollection;
    private $cartItem;
    private $itemPriceCalculatorService;
    private $item;

    public function setUp()
    {
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

    public function testItCanCalculateCorrectPriceForItemAOnlyWithOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('A')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(50)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(3)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(130, $price);
    }

    public function testItCanCalculateCorrectPriceForItemAWithoutOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('A')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(50)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(2)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(100, $price);
    }

    public function testItCanCalculateCorrectPriceForItemAWithAndWithOutOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('A')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(50)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(230, $price);
    }

    public function testItCanCalculateCorrectPriceForItemBOnlyWithOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('B')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(30)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(2)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(45, $price);
    }

    public function testItCanCalculateCorrectPriceForItemBWithOutOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('B')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(30)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(1)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(30, $price);
    }

    public function testItCanCalculateCorrectPriceForItemBWithAndWithOutOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('B')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(30)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(3)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(75, $price);
    }
}