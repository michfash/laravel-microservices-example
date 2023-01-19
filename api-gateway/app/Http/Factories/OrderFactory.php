<?php

namespace App\Http\Factories;

use App\Http\Clients\ProductHttpClient;
use App\Http\Clients\OrderHttpClient;
use App\Http\Clients\UserHttpClient;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderFactory
 * @package App\Http\Factories
 */
class OrderFactory
{
    /**
     * @var UserHttpClient
     */
    private $userClient;

    /**
     * @var OrderHttpClient
     */
    private $orderClient;

    /**
     * @var ProductHttpClient
     */
    private $productClient;

    /**
     * OrderFactory constructor.
     */
    public function __construct()
    {
        $this->userClient = new UserHttpClient();
        $this->orderClient = new OrderHttpClient();
        $this->productClient = new ProductHttpClient();
    }

    /**
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        try {
            $data = [];

            $orders = [];
            $orders = $this->orderClient->getAllOrders();

            foreach ($orders as $orderId => $order) {
                $data[$orderId]['user'] = $this->userClient->getUser($order->userId);
                $data[$orderId]['products'] = $this->productClient->getProducts($order->products)->toArray();
            }

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }

    /**
     * @param int $orderId
     * @return Collection
     */
    public function getOrder(int $orderId): Collection
    {
        try {
            $data = [];

            $order = $this->orderClient->getOrder($orderId);
            $data = $order;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }
}