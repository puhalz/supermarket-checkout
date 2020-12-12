<?php

namespace App\Test\Collection;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item as ItemModel;
use PHPUnit\Framework\TestCase;

class CartCollectionTest extends TestCase
{
    private $cartCollection;

    public function setUp()
    {
        $this->cartCollection = new CartCollection([]);
    }

    public function testItCanCountItemsInTheCartCollection()
    {
        $this->cartCollection->add(new CartItem(new ItemModel('A', 50), 10));
        $this->cartCollection->add(new CartItem(new ItemModel('B', 50), 10));
        $this->cartCollection->add(new CartItem(new ItemModel('C', 50), 10));

        $this->assertEquals(3, $this->cartCollection->count());
    }
}