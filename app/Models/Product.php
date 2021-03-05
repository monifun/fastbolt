<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'options', 'image', 'url', 'price', 'quantity', 'note'
    ];

    protected $casts = [
        'options' => 'array',
        'quantity' => 'integer',
        'price' => 'float',
        'subtotal' => 'float'
    ];

    protected $with = [
        'charges'
    ];

    protected $appends = [
        'charge_total',
        'grand_total',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function charges()
    {
        return $this->morphToMany(Charge::class, 'chargeable')->withPivot('value')->using(Chargeable::class);
    }

    public function shipments()
    {
        return $this->belongsToMany(Shipment::class);
    }

    public function getChargeTotalAttribute()
    {
        $total = $this->charges->reduce(function ($total, $charge) {
            if ($charge->method === 'fixed') {
                switch ($charge->target) {
                    case 'quantity':
                        return $total + $charge->pivot->value * $this->quantity;
                    case 'price':
                        return $total + $charge->pivot->value + $this->price;
                    case 'subtotal':
                        return $total + $charge->pivot->value + $this->subtotal;
                    case 'grandtotal':
                        return $total + $charge->pivot->value + $this->grandtotal;
                }
            } else {
                switch ($charge->target) {
                    case 'quantity':
                        return $total + $charge->pivot->value * $this->quantity / 100;
                    case 'price':
                        return $total + $charge->pivot->value * $this->price / 100;
                    case 'subtotal':
                        return $total + $charge->pivot->value * $this->subtotal / 100;
                    case 'grandtotal':
                        return $total + $charge->pivot->value * $this->grandtotal / 100;
                }
            }
        });

        return round($total ?? 0, 2);
    }

    public function getGrandTotalAttribute()
    {
        return $this->subtotal + $this->charge_total;
    }
}
