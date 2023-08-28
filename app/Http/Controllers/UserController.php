<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function  login(Request $request)
    {
      
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]); 
            $user = User::where('email', $request->email)->first();
            if ($user && ($request->password === $user->password)) {
            
                $token = $user->createToken($request->email)->plainTextToken;
                return response([
                    'token' => $token,
                    'message' => 'Login Success',
                    'status' => 'success'
                ], 200);
            }
            else{
                return response([
                    'message' => 'Your email and password is incorrect',
                    'status' => 'error'
                ], 200);
            }

        } catch (\Illuminate\Validation\ValidationException $exception) {
            // Validation failed
            $errors = $exception->errors();
            return response()->json(['status' => 'failed', 'errors' => $errors, 'message' => 'Validation failed'], 200);
        } catch (\Throwable $th) {
            // Other exceptions occurred
            return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 200);
        }
   }	
   public function loggeduser()
   {
       $loggeduser = auth()->user();
   return response([
       'data' => $loggeduser,
       'message' => 'Logged in user data',
       'status' => 'success'
   ], 200);
   }
   
   public function  logout()
    {

        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Success',
            'status' => 'success'
        ], 200);
    }
}

