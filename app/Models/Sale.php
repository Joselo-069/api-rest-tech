<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'code',
        'monto',
        'date',
        'client_id',
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products', 'sale_id', 'product_id')->withPivot('quantity');
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
