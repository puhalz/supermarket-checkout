<?php

namespace App\Test\Collection;

use App\Collection\ItemCollection;
use App\Model\Item;
use PHPUnit\Framework\TestCase;

class ItemCollectionTest extends TestCase
{
    private $itemCollection;

    public function setUp(): void
    {
        parent::setUp();
        $this->itemCollection = new ItemCollection([]);
    }

    public function testItCanCountItemsInTheCartCollection()
    {
        $this->itemCollection->add(new Item('A', 50));
        $this->itemCollection->add(new Item('B', 50));
        $this->itemCollection->add(new Item('C', 50));

        $this->assertEquals(3, $this->itemCollection->count());
    }

    public function testItCanReturnTrueWhenCartItemsIsEmpty()
    {
        $this->assertEquals(true, $this->itemCollection->isEmpty());
    }

    public function testItCanReturnFalseWhenCartItemsIsNotEmpty()
    {
        $this->itemCollection->add(new Item('A', 50));

        $this->assertEquals(false, $this->itemCollection->isEmpty());
    }
}