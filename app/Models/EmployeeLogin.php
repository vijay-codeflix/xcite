<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeLogin extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'employee_id',
        'branch_id',
        'ip',
        'is_active',
    ];
}
