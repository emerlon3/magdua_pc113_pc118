<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return response ()->json(User::all());
 
   }

 
   public function create(Request $request){
    try {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'course' => 'required|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'first_name' => $validate['first_name'],
            'last_name' => $validate['last_name'],
            'email' => $validate['email'],
            'course' => $validate['course'],
            'password' => bcrypt($validate['password']), // Encrypt password
            'role' => $validate['role'],
        ]);

        return response()->json([
            'message' => 'User registration successful',
            'user' => $user
        ], 201);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function login(Request $request){
    try {
        $student = User::where('email', $request->email)->first();
        
        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('auth_token')->plainTextToken;
            
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'student' => $student
            ], 200);
        }
        
        return response()->json(['message' => 'Login failed'], 401);
    } catch (Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}


          public function update (Request $request, $id)
          {
              $users = User::find($id);
                  if (is_null($users)) {
                      return response()->json(['message' => 'Employee not found'], 404);
                  }
      
                  $validatedData = $request->validate([
                      'first_name' => 'string', 'last_name' => 'string', 'email' =>'string', 'course' => 'string',  'role' => 'string']);
                  $users->update($validatedData);
                  return response()->json([
                    'message' => 'Employee updated successfully', 
                    'user' => $users
      
                    
                  ]);
              }
       
              public function delete($id)
              {
               $users = User:: find($id);
              if (is_null($users)) {
              return response()->json(['message' => 'Users not found'], 404);
              }
              $users->delete();
              return response()->json([
                  
              'message' => 'Users deleted successfully',
                  
              ]);
              }
}
