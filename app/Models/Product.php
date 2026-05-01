<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'user_id',
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'image',
        'category',
        'status',
    ];

    /**
     * Relationship na system_users table
     */
    public function user()
    {
        return $this->belongsTo(SystemUser::class, 'user_id');
    }
}
