<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ProductHttpClient
 * @package App\Http\Clients
 */
class ProductHttpClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ProductHttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'product/']);
    }

    /**
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        try {
            $res = json_decode($this->client->get('product')
                  ->getBody()
                  ->getContents());
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return new Collection($res);
    }

    /**
     * @param array $products
     * @return Collection
     */
    public function getProducts(array $products): Collection
    {
        try {
            $res = [];
            foreach ($products as $product){
              $res[$product] = json_decode($this->client->get(sprintf('product/%d', $product))
                  ->getBody()
                  ->getContents());
            }
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return new Collection($res);
    }

    /**
     * @param int $productId
     * @return string
     */
    public function getProduct(int $productId): string
    {
        try {
            $res = $this->client->get(sprintf('product/%d', $productId));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return json_decode($res->getBody()->getContents());
    }
}