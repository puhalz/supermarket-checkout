<?php
declare(strict_types=1);

namespace App\Controller;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item as ItemModel;
use App\Service\Checkout\CheckoutInterface;
use App\Service\Item\ItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends AbstractController
{
    const NO_OF_ITEMS_A = 4;
    const NO_OF_ITEMS_B = 4;
    const NO_OF_ITEMS_C = 6;
    const NO_OF_ITEMS_D = 9;
    const NO_OF_ITEMS_E = 6;

    public function __construct(ItemInterface $itemService, CheckoutInterface $checkoutService)
    {
        $this->itemService = $itemService;
        $this->checkoutService = $checkoutService;
    }

    /**
     * @Route("/checkout/review/", name="checkout_review")
     */
    public function __invoke(): Response
    {
        $cartItems = new CartCollection([
            new CartItem(new ItemModel('A', 50), self::NO_OF_ITEMS_A),
            new CartItem(new ItemModel('B', 30), self::NO_OF_ITEMS_B),
            new CartItem(new ItemModel('C', 20), self::NO_OF_ITEMS_C),
            new CartItem(new ItemModel('D', 15), self::NO_OF_ITEMS_D),
            new CartItem(new ItemModel('E', 5), self::NO_OF_ITEMS_E)
        ]);

        $priceListCollection = $this->checkoutService->processCart($cartItems);

        return $this->render('cart/list.twig', [
            'item_list' => $cartItems->toArray(),
            'price_list' => $priceListCollection->toArray()
        ]);
    }
}
