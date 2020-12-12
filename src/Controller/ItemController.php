<?php
declare(strict_types=1);

namespace App\Controller;

use App\Collection\CartCollection;
use App\Model\CartItem;
use App\Model\Item;
use App\Model\Item as ItemModel;
use App\Model\PriceList;
use App\Service\Checkout\Checkout;
use App\Service\Item\Item as ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends AbstractController
{
    const NO_OF_ITEMS_A = 4;
    const NO_OF_ITEMS_B = 4;
    const NO_OF_ITEMS_C = 6;
    const NO_OF_ITEMS_D = 9;
    const NO_OF_ITEMS_E = 6;

    public function __construct(ItemService $itemService, Checkout $checkoutService)
    {
        $this->itemService = $itemService;
        $this->checkoutService = $checkoutService;
    }

    /**
     * @Route("/checkout/review/", name="checkout_review")
     */
    public function __invoke(): Response
    {
        $itemA = new ItemModel('A', 50);
        $itemB = new ItemModel('B', 30);
        $itemC = new ItemModel('C', 20);
        $itemD = new ItemModel('D', 15);
        $itemE = new ItemModel('E', 5);

        $addCart1 = new CartItem($itemA, self::NO_OF_ITEMS_A);
        $addCart2 = new CartItem($itemB, self::NO_OF_ITEMS_B);
        $addCart3 = new CartItem($itemC, self::NO_OF_ITEMS_C);
        $addCart4 = new CartItem($itemD, self::NO_OF_ITEMS_D);
        $addCart5 = new CartItem($itemE, self::NO_OF_ITEMS_E);


        $cartItems = new CartCollection([$addCart1, $addCart2, $addCart3, $addCart4, $addCart5]);

        $priceListCollection = $this->checkoutService->processCart($cartItems);

        return $this->render('cart/list.twig', [
            'item_list' => $cartItems->toArray(),
            'price_list' => $priceListCollection->toArray()
        ]);
    }
}