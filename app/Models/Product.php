<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_products', 'product_id', 'sale_id')->withPivot('quantity');
    }
}
