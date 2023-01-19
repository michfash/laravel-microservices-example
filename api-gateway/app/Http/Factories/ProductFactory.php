<?php

namespace App\Http\Factories;

use App\Http\Clients\ProductHttpClient;
use App\Http\Clients\OrderHttpClient;
use App\Http\Clients\UserHttpClient;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ProductFactory
 * @package App\Http\Factories
 */
class ProductFactory
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
     * ProductFactory constructor.
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
    public function getAllProducts(): Collection
    {
        try {
            $data = [];

            $products = [];
            $products = $this->productClient->getAllProducts();
            $data = $products;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }

    /**
     * @param int $productId
     * @return Collection
     */
    public function getProduct(int $productId): Collection
    {
        try {
            $data = [];

            $product = $this->productClient->getProduct($productId);
            $data = $product;

        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }
}