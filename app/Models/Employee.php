<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'employee_id',
        'name',
        'phone_no',
        'password',
        'is_active',
        'branch_id'
    ];
}
