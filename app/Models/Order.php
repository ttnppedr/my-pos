<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS = [
        'holding' => 1,
        'completed' => 2,
    ];

    protected $fillable = ['user_id', 'team_id', 'status', 'amount_receivable', 'amount_received', 'note'];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getDetailAttribute()
    {
        return implode(' / ', $this->products->reduce(function ($arr, $product) {
            $arr[] = $product->name.'*'.$product->quantity;
            return $arr;
        }, []));
    }

    public function getLinkAttribute()
    {
        return route('show-order', $this->id);
    }
}
