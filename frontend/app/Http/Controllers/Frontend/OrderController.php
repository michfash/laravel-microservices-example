<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Clients\OrderHttpClient;

/**
 * Class OrderController.
 */
class OrderController extends Controller
{
    /**
     * @var OrderHttpClient
     */
    private $orderClient;

    /**
     * OrderFactory constructor.
     */
    public function __construct()
    {
        $this->orderClient = new OrderHttpClient();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getAllOrders()
    {
        try {
            $orders_data = $this->orderClient->getAllOrders();
            $orders = [];
            $products_concat_array = [];
            foreach ($orders_data as $orderId => $order) {
                if ($order->products) {
                    foreach ($order->products as $productId => $product) {
                        array_push($products_concat_array, $product);
                    }
                    $products_concat = implode(', ', $products_concat_array);
                    $products_concat_array = [];
                }
                $orders[$orderId]['user'] = $order->user;
                $orders[$orderId]['products_concat'] = $products_concat;
            }
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return view('frontend.order.index')
        ->with('ordersCount', count($orders))
        ->with('orders', $orders);
    }
}
