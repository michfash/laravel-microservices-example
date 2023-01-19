<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Clients\ProductHttpClient;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @var ProductHttpClient
     */
    private $productClient;

    /**
     * OrderFactory constructor.
     */
    public function __construct()
    {
        $this->productClient = new ProductHttpClient();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getAllProducts()
    {
        try {
            $products_data = $this->productClient->getAllProducts();
            $products = [];

            foreach ($products_data as $productId => $product) {
                $products[$productId]['id'] = $productId;
                $products[$productId]['name'] = $product;
            }
        } catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return view('frontend.product.index')
        ->with('productsCount', count($products))
        ->with('products', $products);
    }
}
