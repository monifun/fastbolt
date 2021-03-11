<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Exceptions\CountryCodeException;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['currency_rate', 'shipping_name', 'shipping_phone', 'shipping_address', 'status'];

    protected $casts = [
        'status' => OrderStatus::class,
        'currency_rate' => 'float',
        'shipping_phone' => RawPhoneNumberCast::class.':VN',
        'shipping_phone' => E164PhoneNumberCast::class.':VN',
    ];

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

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'payable');
    }

    public function payments()
    {
        return $this->transactions()->where('type', 'payment');
    }

    public function refunds()
    {
        return $this->transactions()->where('type', 'refund');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getProductPriceTotalAttribute()
    {
        return $this->products->reduce(function ($total, $product) {
            return $total + $product->subtotal;
        }, 0);
    }

    public function getProductChargeTotalAttribute()
    {
        return $this->products->reduce(function ($total, $product) {
            return $total + $product->charge_total;
        }, 0);
    }

    public function getProductGrandTotalAttribute()
    {
        return $this->products->reduce(function ($total, $product) {
            return $total + $product->subtotal + $product->charge_total;
        }, 0);
    }

    public function getChargeTotalAttribute()
    {
        return $this->charges->reduce(function ($total, $charge) {
            if ($charge->method === 'fixed') {
                switch ($charge->target) {
                    case 'subtotal':
                        return $total + $charge->pivot->value + $this->product_price_total;
                    case 'grandtotal':
                        return $total + $charge->pivot->value + $this->grandtotal;
                }
            } else {
                switch ($charge->target) {
                    case 'subtotal':
                        return $total + $charge->pivot->value * $this->product_price_total / 100;
                    case 'grandtotal':
                        return $total + $charge->pivot->value * $this->grandtotal / 100;
                }
            }
        }, 0);
    }

    public function getGrandTotalAttribute()
    {
        return $this->product_grand_total + $this->charge_total;
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments->reduce(function ($total, $payment) {
            return $total + $payment->amount;
        });
    }

    public function getTotalDueAttribute()
    {
        return $this->grand_total * $this->currency_rate - $this->total_paid;
    }
}
