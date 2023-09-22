<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];
}
