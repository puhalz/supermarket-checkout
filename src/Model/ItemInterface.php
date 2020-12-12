<?php
declare(strict_types=1);

namespace App\Model;

interface ItemInterface
{
    public function getItemName(): String;
    public function setItemName(String $itemName): void;

    public function getItemValue(): float;
    public function setItemValue(float $itemValue): void;
}