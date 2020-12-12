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

        $addCart1 = new CartItem($itemA, 7);
        $addCart2 = new CartItem($itemB, 4);
        $addCart3 = new CartItem($itemC, 7);
        $addCart4 = new CartItem($itemD, 8);
        $addCart5 = new CartItem($itemE, 5);


        $cartItems = new CartCollection([$addCart1, $addCart2, $addCart3, $addCart4, $addCart5]);

        $priceListCollection = $this->checkoutService->processCart($cartItems);

        return $this->render('cart/list.twig', [
            'item_list' => $cartItems->toArray(),
            'price_list' => $priceListCollection->toArray()
        ]);
    }
}