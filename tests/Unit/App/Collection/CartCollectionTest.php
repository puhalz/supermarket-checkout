<?php

namespace App\Test\Collection;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item as ItemModel;
use PHPUnit\Framework\TestCase;

class CartCollectionTest extends TestCase
{
    private $cartCollection;

    public function setUp(): void
    {
        parent::setUp();
        $this->cartCollection = new CartCollection([]);
    }

    public function testItCanCountItemsInTheCartCollection()
    {
        $this->cartCollection->add(new CartItem(new ItemModel('A', 50), 10));
        $this->cartCollection->add(new CartItem(new ItemModel('B', 50), 10));
        $this->cartCollection->add(new CartItem(new ItemModel('C', 50), 10));

        $this->assertEquals(3, $this->cartCollection->count());
    }

    public function testItCanReturnTrueWhenCartItemsIsEmpty()
    {
        $this->assertEquals(true, $this->cartCollection->isEmpty());
    }

    public function testItCanReturnFalseWhenCartItemsIsNotEmpty()
    {
        $this->cartCollection->add(new CartItem(new ItemModel('A', 50), 10));

        $this->assertEquals(false, $this->cartCollection->isEmpty());
    }

    public function testItCanReturnArrayOnCallingToarray()
    {
        $this->cartCollection->add(new CartItem(new ItemModel('A', 50), 10));
        $this->cartCollection->add(new CartItem(new ItemModel('B', 50), 10));

        $collectionArray = $this->cartCollection->toArray();
        $this->assertEquals('A', $collectionArray[0]['itemName']);

        $collectionArray = $this->cartCollection->toArray();
        $this->assertEquals('B', $collectionArray[1]['itemName']);
    }
}