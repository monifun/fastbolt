<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'carrier_name',
        'tracking_number',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'currency_code',
        'currency_rate',
        'note'
    ];

    protected $casts = [
        'status' => ShipmentStatus::class
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
