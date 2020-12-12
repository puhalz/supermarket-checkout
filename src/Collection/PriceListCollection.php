<?php
declare(strict_types=1);

namespace App\Collection;

use App\Model\PriceList;

class PriceListCollection implements \IteratorAggregate, \Countable
{
    /** @var PriceList[] */
    private $priceList = [];

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
        return 0 === count($this->priceList);
    }

    /**
     * @return PriceList[]
     */
    public function toArray(): array
    {
        $priceListArray = [];
        foreach ($this->priceList as $item) {
            $priceListArray[] = [
                'itemName' => $item->getItem()->getItemName(),
                'noOfItems' => $item->getNoOfItems(),
                'totalPrice' => $item->getTotalPrice()
            ];
        }

        return $priceListArray;
    }
}
