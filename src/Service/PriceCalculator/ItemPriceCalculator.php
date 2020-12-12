<?php

declare(strict_types=1);

namespace App\Service\PriceCalculator;

use App\Collection\CartCollection;
use App\Factory\OfferCalculatorFinderFactory;
use App\Model\CartItemInterface;
use Psr\Log\LoggerInterface;

class ItemPriceCalculator implements ItemPriceCalculatorInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function calculatePrice(CartItemInterface $cartItem, CartCollection $cartCollection): float
    {
        try {
            $offerCalculator = OfferCalculatorFinderFactory::create($cartItem->getItem()->getItemName());

            if ($offerCalculator instanceof OfferCalculatorInterface) {
                return $offerCalculator->calculate($cartItem, $cartCollection);
            }
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }

        return 0;
    }
}
