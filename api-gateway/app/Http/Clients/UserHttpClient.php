<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class UserHttpClient
 * @package App\Http\Clients
 */
class UserHttpClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var OrderClient
     */
    private $orderClient;

    /**
     * UserHttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'user/']);
        $this->orderClient = new Client(['base_uri' => 'order/']);
    }

    /**
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        try {
            $res = json_decode($this->client->get('user')
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
     * @param int $userId
     * @return string
     */
    public function getUser(int $userId): string
    {
        try {
            $res = $this->client->get(sprintf('user/%d', $userId));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return json_decode($res->getBody()->getContents());
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserOrders(int $userId): Collection
    {
        try {
            $res = $this->orderClient->get(sprintf('order/user/%d', $userId));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return new Collection(json_decode($res->getBody()->getContents(), true));
    }
}