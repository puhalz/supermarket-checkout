<?php
declare(strict_types=1);

namespace App\Factory;

use App\Exception\ItemNotFoundException;
use App\Model\Item;
use App\Service\PriceCalculator\NoOfferCalculator;
use App\Service\PriceCalculator\NormalOfferCalculator;
use App\Service\PriceCalculator\OfferCalculatorInterface;
use App\Service\PriceCalculator\OfferCombinationCalculator;
use App\Service\PriceCalculator\OfferWithOtherItem;

class OfferCalculatorFinderFactory
{
    const NORMAL_OFFER = [Item::ITEM_A, Item::ITEM_B];
    const OFFER_COMBINATION = [Item::ITEM_C];
    const OFFER_BASED_ON_OTHER_ITEM = [Item::ITEM_D];
    const NO_OFFER = [Item::ITEM_E];

    public static function create($itemName): OfferCalculatorInterface
    {
        if (in_array($itemName, self::NORMAL_OFFER)) {
            return new NormalOfferCalculator();
        }

        if (in_array($itemName, self::OFFER_COMBINATION)) {
            return new OfferCombinationCalculator();
        }

        if (in_array($itemName, self::OFFER_BASED_ON_OTHER_ITEM)) {
            return new OfferWithOtherItem();
        }

        if (in_array($itemName, self::NO_OFFER)) {
            return new NoOfferCalculator();
        }

        throw new ItemNotFoundException($itemName);
    }
}