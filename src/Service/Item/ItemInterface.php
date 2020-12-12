<?php
declare(strict_types=1);

namespace App\Service\Item;

use App\Collection\ItemCollection;
use App\Model\Item;

interface ItemInterface
{
    public function add(Item $item);

    public function fetchOne(): Item;

    public function fetchAll(): ItemCollection;
}
