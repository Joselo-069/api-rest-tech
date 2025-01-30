<?php

namespace App\Repositories;

use App\Models\Problem;
use App\Models\SaleProduct;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getProductsTop()
    {
        return SaleProduct::query()
        ->join('products', function ($join) {
            $join->on('sale_products.product_id', '=', 'products.id')
                ->whereNull('products.deleted_at'); // Incluir productos eliminados
        })
        ->join('sales', 'sale_products.sale_id', '=', 'sales.id')
        ->join('clients', 'sales.client_id', '=', 'clients.id')
        ->join('users', 'sales.user_id', '=', 'users.id')
        ->select(
            'products.sku',
            'products.name',
            \DB::raw('SUM(sale_products.quantity) as total_quantity'),
            \DB::raw('SUM(sale_products.quantity * products.price) as total_amount')
        )
        ->groupBy('products.sku', 'products.name')
        ->orderByDesc('total_quantity')
        ->limit(20);
    }
}
