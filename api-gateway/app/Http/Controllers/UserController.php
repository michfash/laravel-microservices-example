<?php
namespace App\Http\Controllers;

use App\Http\Factories\UserFactory;
use App\Http\Factories\OrderFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getAllUsers(): JsonResponse
    {
        try {
            $data = (new UserFactory())->getAllUsers();
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

    /**
     * @param int $userId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getUser(int $userId): JsonResponse
    {
        try {
            $data = (new UserFactory())->getUser($userId);
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

    /**
     * @param int $userId
     * @return JsonResponse
     * @internal param string $order
     * @internal param Request $request
     */
    public function getUserOrders(int $userId): JsonResponse
    {
        try {
            $data = (new UserFactory())->getUserOrders($userId);
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

}
