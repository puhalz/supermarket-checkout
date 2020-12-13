<?php

namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Service\PriceCalculator\ItemPriceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ItemsWithTwoOfferTest extends TestCase
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

    public function testItCanCalculateCorrectPriceForItemCOnlyWithFirstOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('C')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(20)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(2)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(38, $price);
    }

    public function testItCanCalculateCorrectPriceForItemCOnlyWithSecondOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('C')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(20)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(3)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(50, $price);
    }

    public function testItCanCalculateCorrectPriceForItemCOnlyWithFirstAndSecondOffer()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('C')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(20)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(88, $price);
    }

    public function testItCanCalculateCorrectPriceForItemCOnlyWithSecondOfferPlusOne()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('C')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(20)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(4)
            ->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(70, $price);
    }
}