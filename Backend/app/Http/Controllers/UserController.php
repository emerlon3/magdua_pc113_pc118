<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
            'password' => bcrypt($validate['password']),
            'role' => $validate['role'],
        ]);

        return response()->json([
            'message' => 'User registration successful',
            'user' => $user
        ], 201);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (Exception $e) {
        return response()->json(['error' => 'email already taken'], 500);
    }
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
        ]);
    } else {
        return response()->json(['message' => 'Invalid credentials'], 401);
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

        public function index(Request $request)
        {
            $users = User::all();

            return response()->json($users);
        }


public function logout(Request $request)
{
    // Log the user out by invalidating the token
    Auth::logout(); // This is used for traditional authentication
    // If using JWT, you would revoke the token like this:
    // $request->user()->token()->revoke();

    return response()->json(['message' => 'Logout successful.'], 200);
}
}
