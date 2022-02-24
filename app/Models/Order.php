<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS = [
        'holding' => 1,
        'completed' => 2,
    ];

    protected $fillable = ['user_id', 'status', 'amount_receivable', 'amount_received'];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getDetailAttribute()
    {
        return implode(', ', $this->products->reduce(function ($arr, $product) {
            $arr[] = $product->name.' *'.$product->quantity;
            return $arr;
        }, []));
    }
}
