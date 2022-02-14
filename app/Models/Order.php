<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS = [
        'Hold' => 1,
        'Completed' => 2,
    ];

    protected $fillable = ['user_id', 'status', 'sub_total', 'discount', 'total', 'products'];

    protected $casts = [
        'products' => 'json',
    ];
}
