<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    /**
     * @var $products Collection
     */
    private $products;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->products = new Collection([
            "1" => "Product 1",
            "2" => "Product 2",
            "3" => "Product 3",
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->products->toArray(), 200);
    }

    /**
     * @param int $product
     * @return JsonResponse
     * @internal param Request $request
     */
    public function show(int $productId): JsonResponse
    {
        if (! $this->products->get($productId)){
            return new JsonResponse(
                'Product not found',
                404
            );
        }

        return new JsonResponse($this->products->get($productId), 200);
    }

}
