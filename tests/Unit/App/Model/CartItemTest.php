<?php

namespace App\Test\Model;

use App\Model\CartItem;
use App\Model\Item;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{
    private $item;
    private $cartItem;

    public function setUp(): void
    {
        parent::setUp();

        $this->item = new Item('ItemTestA', 50);

        $this->cartItem = new CartItem($this->item, 5);
    }

    public function testItCanGetCartItem()
    {
        $this->assertEquals('ItemTestA', $this->cartItem->getItem()->getItemName());
        $this->assertEquals(50, $this->cartItem->getItem()->getItemValue());
    }
}