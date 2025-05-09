<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function create(Request $request){
  $validate = $request->validate([
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|string|email|max:255|unique:students',
        'course' => 'required|max:255',

    
  ]);
    $user = Student::create([
        'first_name' =>$validate['first_name'],
        'last_name' =>$validate['last_name'],
        'email' =>$validate['email'],
        'course' =>$validate['course'],
       
       

    ]);
    return response()->json([
        'message' => 'User registration succes',
        'user' => $user
    ]);
  
    }
    public function login(Request $request){
        $student = student::where('email', $request->email)->first();
        if($student){
     $token = $student->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
     'token' => $token,
                'student' => $student
            ]);
        }else{
            return response()->json([
                'message' => 'Login failed'
            ]);
        }
    }

}
