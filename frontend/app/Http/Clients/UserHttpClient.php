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
     * UserHttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'api-gateway/']);
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
     * @return mixed
     */
    public function getOrder(int $userId): mixed
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
}