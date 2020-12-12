<?php
declare(strict_types=1);

namespace App\Model;

interface CartItemInterface
{
    public function getItem(): Item;
    public function setItem(Item $item): void;
    public function getNoOfItems(): int;
    public function setNoOfItems(int $noOfItems): void;
}