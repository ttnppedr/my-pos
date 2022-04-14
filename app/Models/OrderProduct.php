<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['ordor_id', 'product_id', 'name', 'type', 'price', 'cost', 'quantity', 'note'];
}
