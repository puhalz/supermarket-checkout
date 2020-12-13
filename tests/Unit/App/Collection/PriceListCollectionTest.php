<?php

namespace App\Test\Collection;

use App\Collection\PriceListCollection;
use App\Model\Item as ItemModel;
use App\Model\PriceList;
use PHPUnit\Framework\TestCase;

class PriceListCollectionTest extends TestCase
{
    private $priceListCollection;

    public function setUp(): void
    {
        parent::setUp();

        $this->priceListCollection = new PriceListCollection([]);
    }

    public function testItCanCountItemsInTheCartCollection()
    {
        $this->priceListCollection->add(new PriceList(new ItemModel('A', 50), 3, 130));
        $this->priceListCollection->add(new PriceList(new ItemModel('B', 50), 2, 45));
        $this->priceListCollection->add(new PriceList(new ItemModel('C', 50), 1, 20));

        $this->assertEquals(3,  $this->priceListCollection->count());
    }

    public function testItCanReturnTrueWhenCartItemsIsEmpty()
    {
        $this->assertEquals(true, $this->priceListCollection->isEmpty());
    }

    public function testItCanReturnFalseWhenCartItemsIsNotEmpty()
    {
        $this->priceListCollection->add(new PriceList(new ItemModel('A', 50), 10, 10));

        $this->assertEquals(false, $this->priceListCollection->isEmpty());
    }

    public function testItCanReturnArrayOnCallingToarray()
    {
        $this->priceListCollection->add(new PriceList(new ItemModel('A', 50), 10, 100));
        $this->priceListCollection->add(new PriceList(new ItemModel('B', 50), 10, 50));

        $collectionArray = $this->priceListCollection->toArray();
        $this->assertEquals('A', $collectionArray[0]['itemName']);

        $collectionArray = $this->priceListCollection->toArray();
        $this->assertEquals(100, $collectionArray[0]['totalPrice']);

        $collectionArray = $this->priceListCollection->toArray();
        $this->assertEquals('B', $collectionArray[1]['itemName']);

        $collectionArray = $this->priceListCollection->toArray();
        $this->assertEquals(50, $collectionArray[1]['totalPrice']);
    }

    public function testItCanReturnArrayIterator()
    {
        $this->priceListCollection->add(new PriceList(new ItemModel('A', 50), 10, 100));
        $this->priceListCollection->add(new PriceList(new ItemModel('B', 50), 10, 50));

        $this->assertInstanceOf( \ArrayIterator::class, $this->priceListCollection->getIterator());
    }
}