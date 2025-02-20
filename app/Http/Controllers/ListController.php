<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\employees;

class ListController extends Controller
{
    public function student()
    {
        return response ()->json(student::all());
 
   }

   public function employee()
   {
       return response ()->json(employee::all());
   }
}
