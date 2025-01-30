<?php

namespace App\Services;

use App\Models\Product;

class SaleProductService
{

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getRegisterDetailSaleProducts($sale, $products)
    {
        $totalAmount = 0;

        foreach ($products as $product) {

            $productData = Product::find($product['product_id']);

            // if (!$productData) {
            //     continue;
            // }

            $subtotal = $productData->price * $product['quantity'];
            $totalAmount += $subtotal;

            $sale->products()->attach($product['product_id'], [
                'quantity' => $product['quantity']
            ]);

            $this->productService->updateStock($product['product_id'], $product['quantity']);
        }

        $sale->update(['monto' => $totalAmount]);
    }

    public function getDetailSaleProducts($sale)
    {
        $products = $sale->products()->get();

        return [
            'products' => $products,
            'client' => $sale->clients,
            'total mount' => $sale->monto
        ];
    }

}