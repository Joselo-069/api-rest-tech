<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getListProducts()
    {
        $products = Product::whereNull('deleted_at')->get();

        return [
            'products' => $products
        ];
    }

    public function getRegisterProduct(StoreProductRequest $request): array
    {
        $product = Product::create($request->validated());

        return [
            'product' => $product
        ];
    }

    public function getDetailProduct($id): array
    {
        $product = Product::findOrFail($id);

        return [
            'product' => $product
        ];
    }

    public function getUpdateProduct($request)
    {
        $product = Product::findOrFail($request->id);
        $product->update($request->all());

        return [
            'product' => $product
        ];
    }

    public function getDestroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return [
            'message' => 'Product deleted successfully'
        ];
    }

    public function getProductIsActive($productId)
    {
        $product = Product::findOrFail($productId);
        return $product->active;
    }

    public function getStockIsAvailable($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        return $product->stock < $quantity;
    }

    public function updateStock($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        $product->stock = $product->stock - $quantity;
        $product->save();
    }

    public function validationsProblems($products) {
        foreach ($products as $product) {
            if (!$this->getProductIsActive($product['product_id'])) {
                return [
                    "message" => 'Product is not active'
                ];
            }

            if ($this->getStockIsAvailable($product['product_id'], $product['quantity'])) {
                return [
                    "message" => 'Product stock is not available'
                ];

            }
        }
    }

    public function report($request){
        
    }

}