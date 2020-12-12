<?php
declare(strict_types=1);

namespace App\Service\Item;

use App\Collection\ItemCollection;
use App\Factory\ItemFactory;
use App\Model\Item as ItemModel;

class Item implements ItemInterface
{
    public function add(ItemModel $item)
    {
        // TODO: Implement add() method.
    }

    public function fetchOne(): ItemModel
    {
        // TODO: Implement fetchOne() method.
    }

    public function fetchAll(): ItemCollection
    {
        return new ItemCollection(
            ItemFactory::createItems()
        );
    }
}
