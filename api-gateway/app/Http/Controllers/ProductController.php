<?php
namespace App\Http\Controllers;

use App\Http\Factories\ProductFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductController extends Controller
{
    /**
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getAllProducts(): JsonResponse
    {
        try {
            $data = (new ProductFactory())->getAllProducts();
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

    /**
     * @param int $productId
     * @return JsonResponse
     * @internal param Request $request
     */
    public function getProduct(int $productId): JsonResponse
    {
        try {
            $data = (new ProductFactory())->getProduct($productId);
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

}
