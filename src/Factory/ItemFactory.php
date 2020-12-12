<?php
declare(strict_types=1);

namespace App\Factory;

use App\Model\Item as ItemModel;

class ItemFactory
{
    public static function createItems() : array
    {
        $itemA = new ItemModel('A', 50);
        $itemB = new ItemModel('B', 30);
        $itemC = new ItemModel('C', 20);
        $itemD = new ItemModel('D', 15);
        $itemE = new ItemModel('E', 5);

        return [
            $itemA,
            $itemB,
            $itemC,
            $itemD,
            $itemE,
        ];
    }
}
