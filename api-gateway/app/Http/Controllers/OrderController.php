<?php
namespace App\Http\Controllers;

use App\Http\Factories\OrderFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{
    /**
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getAllOrders(): JsonResponse
    {
        try {
            $data = (new OrderFactory())->getAllOrders();
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

    /**
     * @param int $orderId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getOrder(int $orderId): JsonResponse
    {
        try {
            $data = (new OrderFactory())->getOrder($orderId);
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

}
