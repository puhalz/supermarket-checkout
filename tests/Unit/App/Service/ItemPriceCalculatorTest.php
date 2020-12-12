<?php

namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Model\Item as ItemModel;
use App\Service\PriceCalculator\ItemPriceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ItemPriceCalculatorTest extends TestCase
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

    public function testItCanCalculateCorrectPriceForItemDWhenNuberOfItemsInAandItemsInDAreEqual()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('D')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(15)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $this->cartItemsNew = \Mockery::mock(CartItem::class);
        $this->cartCollection->shouldReceive('getIterator')
            ->andReturn(new \ArrayIterator([new CartItem(new ItemModel('A', 50), 5)]))->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(25, $price);
    }

    public function testItCanCalculateCorrectPriceForItemDWhenNuberOfItemsInAisLessThanItemsInD()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('D')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(15)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $this->cartItemsNew = \Mockery::mock(CartItem::class);
        $this->cartCollection->shouldReceive('getIterator')
            ->andReturn(new \ArrayIterator([new CartItem(new ItemModel('A', 50), 4)]))->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(35, $price);
    }

    public function testItCanCalculateCorrectPriceForItemDWhenNuberOfItemsInAisMoreThanItemsInD()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('D')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(15)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(5)
            ->getMock();

        $this->cartItemsNew = \Mockery::mock(CartItem::class);
        $this->cartCollection->shouldReceive('getIterator')
            ->andReturn(new \ArrayIterator([new CartItem(new ItemModel('A', 50), 10)]))->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(25, $price);
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