<?php
declare(strict_types=1);

namespace App\Collection;

use App\Model\PriceList;

class PriceListCollection implements \IteratorAggregate, \Countable
{
    /** @var PriceList[] */
    private $priceList;

    public function __construct(array $priceList = [])
    {
        foreach ($priceList as $price) {
            $this->add($price);
        }
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->priceList);
    }

    public function count(): int
    {
        return \count($this->priceList);
    }

    public function add(PriceList $priceListItem): void
    {
        $this->priceList[] = $priceListItem;
    }

    public function isEmpty(): bool
    {
        return [] === $this->priceList;
    }

    /**
     * @return PriceList[]
     */
    public function toArray(): array
    {
        return $this->priceList;
    }
}
