<?php
declare(strict_types=1);

namespace App\Model;

class Item implements ItemInterface
{
    const ITEM_A = 'A';
    const ITEM_B = 'B';
    const ITEM_C = 'C';
    const ITEM_D = 'D';
    const ITEM_E = 'E';

    private $itemName;

    private $itemValue;

    public function __construct(String $itemName, float $itemValue)
    {
        $this->itemName = $itemName;
        $this->itemValue = $itemValue;
    }

    /**
     * @return String
     */
    public function getItemName(): String
    {
        return (String) $this->itemName;
    }

    /**
     * @param String $itemName
     */
    public function setItemName(String $itemName): void
    {
        $this->itemName = $itemName;
    }

    /**
     * @return float
     */
    public function getItemValue(): float
    {
        return $this->itemValue;
    }

    /**
     * @param float $itemValue
     */
    public function setItemValue(float $itemValue): void
    {
        $this->itemValue = $itemValue;
    }
}
