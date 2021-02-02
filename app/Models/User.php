<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Propaganistas\LaravelPhone\Exceptions\CountryCodeException;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPhoneAttribute($value): string
    {
        return $this->attributes['phone'] = (string) phone($value, 'VN');
    }

    public function getPhoneAttribute($value): string
    {
        try {
            return phone($value)->formatForCountry('VN');
        } catch (CountryCodeException $e) {
            return $value;
        }
    }

    public function scopeWherePhone($query, $phone)
    {
        $number = (string) phone($phone, 'VN');
        return $query->where('phone', $number);
    }
}
