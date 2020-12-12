<?php

namespace App\Test\Factory;

use App\Exception\ItemNotFoundException;
use App\Factory\OfferCalculatorFinderFactory;
use App\Service\PriceCalculator\ItemsWithMultipleOffer;
use App\Service\PriceCalculator\ItemsWithNoOffer;
use App\Service\PriceCalculator\ItemsWithSingleOffer;
use App\Service\PriceCalculator\OfferWithOtherItem;
use PHPUnit\Framework\TestCase;

class OfferCalculatorFinderFactoryTest extends TestCase
{
    public function testItCanReturnCorrectClassForItemName()
    {
        $offerClass = OfferCalculatorFinderFactory::create('A');
        $this->assertInstanceOf(ItemsWithSingleOffer::class, $offerClass);

        $offerClass = OfferCalculatorFinderFactory::create('B');
        $this->assertInstanceOf(ItemsWithSingleOffer::class, $offerClass);

        $offerClass = OfferCalculatorFinderFactory::create('C');
        $this->assertInstanceOf(ItemsWithMultipleOffer::class, $offerClass);

        $offerClass = OfferCalculatorFinderFactory::create('D');
        $this->assertInstanceOf(OfferWithOtherItem::class, $offerClass);

        $offerClass = OfferCalculatorFinderFactory::create('E');
        $this->assertInstanceOf(ItemsWithNoOffer::class, $offerClass);
    }

    public function testItCanthrowExceptionForInvalidItemName()
    {
        $this->expectException(ItemNotFoundException::class);
        OfferCalculatorFinderFactory::create('X');
    }
}