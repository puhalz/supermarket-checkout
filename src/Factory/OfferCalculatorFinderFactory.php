<?php
declare(strict_types=1);

namespace App\Factory;

use App\Exception\ItemNotFoundException;
use App\Model\Item;
use App\Service\PriceCalculator\ItemsWithNoOffer;
use App\Service\PriceCalculator\ItemsWithOneOffer;
use App\Service\PriceCalculator\OfferCalculatorInterface;
use App\Service\PriceCalculator\ItemsWithTwoOffer;
use App\Service\PriceCalculator\OfferWithOtherItem;

class OfferCalculatorFinderFactory
{
    const SINGLE_OFFER = [Item::ITEM_A, Item::ITEM_B];
    const OFFER_COMBINATION = [Item::ITEM_C];
    const OFFER_BASED_ON_OTHER_ITEM = [Item::ITEM_D];
    const NO_OFFER = [Item::ITEM_E];

    /**
     * @param $itemName
     *
     * @return OfferCalculatorInterface
     *
     * @throws ItemNotFoundException
     */
    public static function create($itemName): OfferCalculatorInterface
    {
        if (in_array($itemName, self::SINGLE_OFFER)) {
            return new ItemsWithOneOffer();
        }

        if (in_array($itemName, self::OFFER_COMBINATION)) {
            return new ItemsWithTwoOffer();
        }

        if (in_array($itemName, self::OFFER_BASED_ON_OTHER_ITEM)) {
            return new OfferWithOtherItem();
        }

        if (in_array($itemName, self::NO_OFFER)) {
            return new ItemsWithNoOffer();
        }

        throw ItemNotFoundException::byItemName($itemName);
    }
}
