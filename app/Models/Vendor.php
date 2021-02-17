<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['market_id', 'identity', 'name'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('identity', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%');
        });
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
