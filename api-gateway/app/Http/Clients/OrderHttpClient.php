<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderHttpClient
 * @package App\Http\Clients
 */
class OrderHttpClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * OrderHttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'order/']);
    }

    /**
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        try {
            $res = json_decode($this->client->get('order')
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
     * @param int $orderId
     * @return mixed
     */
    public function getOrder(int $orderId): mixed
    {
        try {
            $res = $this->client->get(sprintf('order/%d', $orderId));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return json_decode($res->getBody()->getContents());
    }
}