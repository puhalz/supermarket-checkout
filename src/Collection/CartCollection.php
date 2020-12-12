<?php
declare(strict_types=1);

namespace App\Collection;

use App\Model\CartItem;

class CartCollection implements \IteratorAggregate, \Countable
{
    /** @var CartItem[] */
    private $cartItems = [];

    public function __construct(array $cartItems = [])
    {
        foreach ($cartItems as $cartItem) {
            $this->add($cartItem);
        }
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->cartItems);
    }

    public function count(): int
    {
        return \count($this->cartItems);
    }

    public function add(CartItem $cartItem): void
    {
        $this->cartItems[] = $cartItem;
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->cartItems);
    }

    /**
     * @return CartItem[]
     */
    public function toArray(): array
    {
        $cartItems = [];
        foreach ($this->cartItems as $cartItem) {
            $cartItems[] = [
                'itemName' => $cartItem->getItem()->getItemName(),
                'itemValue' => $cartItem->getItem()->getItemValue()
            ];
        }

        return $cartItems;
    }
}
