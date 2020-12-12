<?php

declare(strict_types=1);

namespace App\Collection;

use App\Model\Item;

class ItemCollection implements \IteratorAggregate, \Countable
{
    /** @var Item[] */
    private $items;

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function add(Item $item): void
    {
        $this->items[] = $item;
    }

    public function isEmpty(): bool
    {
        return [] === $this->items;
    }

    /**
     * @return Item[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
