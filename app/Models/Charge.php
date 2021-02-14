<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'method',
        'target',
        'value',
        'description'
    ];

    protected $casts = [
        'value' => 'float'
    ];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'chargeable');
    }
}
