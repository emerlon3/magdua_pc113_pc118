<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'position',
        'salary',
        
    ];
}
