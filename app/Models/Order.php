<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Exceptions\CountryCodeException;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['currency_rate', 'shipping_name', 'shipping_phone', 'shipping_address', 'status'];

    protected $casts = [
        'status' => OrderStatus::class,
        'currency_rate' => 'float'
    ];

    public function setShippingPhoneAttribute($value): string
    {
        return $this->attributes['shipping_phone'] = (string) phone($value, 'VN');
    }

    public function getShippingPhoneAttribute($value): string
    {
        try {
            return (string) phone($value)->formatForMobileDialingInCountry('VN');
        } catch (CountryCodeException $e) {
            return $value;
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('id', 'like', '%'.$search.'%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function charges()
    {
        return $this->morphToMany(Charge::class, 'chargeable')
            ->withPivot('value')
            ->using(Chargeable::class)
            ->whereIn('target', ['subtotal', 'grandtotal']);
    }
}
