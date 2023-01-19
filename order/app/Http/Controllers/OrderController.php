<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    /**
     * @var $products Collection
     */
    private $orders;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->orders = new Collection([
            "1" => ["userId" => "1", "products" => ["1", "2"]],
            "2" => ["userId" => "1", "products" => ["3"] ],
            "3" => ["userId" => "2", "products" => ["1", "3"]],
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->orders->toArray(), 200);
    }

    /**
     * @param int $orderId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function show(int $orderId): JsonResponse
    {
        if (! $this->orders->get($orderId)){
            return new JsonResponse(
                'Order not found',
                404
            );
        }

        return new JsonResponse($this->orders->get($orderId), 200);
    }

    /**
     * @param int $userId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function showByUser(int $userId): JsonResponse
    {
        $results = array_filter($this->orders->toArray(), function($order) use ($userId) {
            return (is_array($order) && $order['userId'] == $userId);
        });

        if (empty($results)){
            return new JsonResponse(
                'No orders found for this user',
                404
            );
        }

        return new JsonResponse($results, 200);
    }

}
