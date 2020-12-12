<?php
declare(strict_types=1);

namespace App\Model;

class PriceList implements PriceListInterface
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var int
     */
    private $noOfItems;

    /**
     * @var float
     */
    private $totalPrice;

    public function __construct(ItemInterface $item, int $noOfItems, float $totalPrice)
    {
        $this->item = $item;
        $this->noOfItems = $noOfItems;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item): void
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getNoOfItems(): int
    {
        return $this->noOfItems;
    }

    /**
     * @param int $noOfItems
     */
    public function setNoOfItems(int $noOfItems): void
    {
        $this->noOfItems = $noOfItems;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }
}
