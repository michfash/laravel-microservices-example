<?php

namespace App\Http\Factories;

use App\Http\Clients\ProductHttpClient;
use App\Http\Clients\OrderHttpClient;
use App\Http\Clients\UserHttpClient;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class UserFactory
 * @package App\Http\Factories
 */
class UserFactory
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
    public function getAllUsers(): Collection
    {
        try {
            $data = [];

            $users = $this->userClient->getAllUsers();
            $data = $users;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUser(int $userId): Collection
    {
        try {
            $data = [];

            $user = $this->userClient->getUser($userId);
            $data = $user;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserOrders(int $userId): Collection
    {
        try {
            $data = [];

            $user = [];
            $user["id"] = $userId;
            $user["name"] = $this->userClient->getUser($userId);
            $data["user"] = $user;

            // lot of optimization can be done here
            // this is just a simple example
            $res = [];
            foreach ($this->userClient->getUserOrders($userId) as $orderId => $order) {
                if (array_key_exists("products", $order)) {
                    $res[$orderId] = $this->productClient->getProducts($order["products"])->toArray();
                };
            }
            $data["orders"] = $res;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }
}