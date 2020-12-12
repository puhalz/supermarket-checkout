<?php

namespace App\Test\Service;

use App\Collection\ItemCollection;
use App\Service\Item\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItCanFetchAllItems()
    {
        $this->itemService = new Item();

        $items = $this->itemService->fetchAll();

        $this->assertInstanceOf(ItemCollection::class, $items);

        $this->assertEquals( 5, $items->count());

        $this->assertEquals('A', $items->getIterator()->current()->getItemName());
    }
}