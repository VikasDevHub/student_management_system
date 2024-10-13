<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profile_image',
        'phone_no',
        'email',
        'password',
        'city',
        'tel',
        'zipcode',
        'dist',
        'address'
    ];
}
