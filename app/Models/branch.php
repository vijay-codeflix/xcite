<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class branch extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = [
        'branch_name',
        'address',
        'phone_no',
        'opening_time',
        'closing_time',
        'is_active',
    ];
}
