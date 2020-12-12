<?php
declare(strict_types=1);

namespace App\Model;

use App\Exception\InvalidCartException;
use App\Exception\InvalidItemException;

class CartItem implements CartItemInterface
{
    /**
     * @var Item
     */
    private $item;

    /**
     * @var int
     */
    private $noOfItems;

    public function __construct(ItemInterface $item, int $noOfItems)
    {
        if($noOfItems < 0) {
            throw InvalidCartException::negativeCartItems();
        }

        $this->item = $item;
        $this->noOfItems = $noOfItems;
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
}
