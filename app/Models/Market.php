<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'website', 'currency_code', 'description'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('website', 'like', '%'.$search.'%');
        });
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Vendor::class);
    }
}
