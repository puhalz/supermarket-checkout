<?php


namespace App\Test\Service;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Model\Item as ItemModel;
use App\Service\PriceCalculator\ItemPriceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class OfferWithOtherItemTest extends TestCase
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

    public function testItCanCalculateCorrectPriceForItemDWhenNuberOfItemsInAisZero()
    {
        $this->item->shouldReceive('getItemName')
            ->andReturn('D')
            ->getMock();

        $this->item->shouldReceive('getItemValue')
            ->andReturn(15)
            ->getMock();

        $this->cartItem->shouldReceive('getNoOfItems')
            ->andReturn(2)
            ->getMock();

        $this->cartItemsNew = \Mockery::mock(CartItem::class);
        $this->cartCollection->shouldReceive('getIterator')
            ->andReturn(new \ArrayIterator([new CartItem(new ItemModel('A', 50), 0)]))->getMock();

        $price = $this->itemPriceCalculatorService->calculatePrice($this->cartItem, $this->cartCollection);

        $this->assertEquals(30, $price);
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
}