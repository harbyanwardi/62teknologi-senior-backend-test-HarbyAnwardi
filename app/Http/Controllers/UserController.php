<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth; 

class UserController extends Controller
{
   

    public function index()
    {
        $userCurrent =  Auth::user();
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $users,
            'current' => $userCurrent['id']
        ]);

    }

    
    public function create(Request $request)
    {
        $rules = [
            'fullname' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'type' => 'required|string'
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $credit = 0;

        if($data['type'] == 'reguler') {
            $credit = 20;
        } elseif ($data['type'] == 'premium') {
            $credit = 40;
        }

        $insertData = array(
            "fullname" => $data['fullname'],
            "username" => $data['username'],
            "password" => Hash::make($data['password']),
            "type" => $data['type'],
            "credit" => $credit
        );

        
        try { 
            $user = User::create($insertData);
            $data = array(
                "credit" => $user->credit,
                "token" => JWTAuth::fromUser($user),
            );
            return response()->json([
                'code' => 201,
                'status' => 'success',
                'data' => $data,

            ],201);
          } catch(Exception $e) { 
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
          }

        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'invalid credentials'
                ], 401);
            }
        } catch (JWTException $e) {
           
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'could not create token'
            ], 500);
        }
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Login Success',
            'token' => $token
        ], 200);
        
    }

    // public function getAuthenticatedUser()
    // {
    //     try {

    //         if (! $user = JWTAuth::parseToken()->authenticate()) {
    //             return response()->json(['user_not_found'], 404);
    //         }

    //     } catch (TokenExpiredException $e) {

    //         return response()->json(['token_expired'], $e->getStatusCode());

    //     } catch (TokenInvalidException $e) {

    //         return response()->json(['token_invalid'], $e->getStatusCode());

    //     } catch (JWTException $e) {

    //         return response()->json(['token_absent'], $e->getStatusCode());

    //     }

    //     return response()->json(compact('user'));
    // }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'profile' => 'url',
            'profession' => 'string',
            'email' => 'email'
        ];
        $data = $request->all();

        $validator = Validator::make($data, $rules);   
        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $mentor = User::find($id);
        if(!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Found'
            ], 404);
        }

        $mentor->fill($data);
        $mentor->save();
        return response()->json([
            'status' => 'success',
            'data' => $mentor
        ]);
    }

    public function destroy($id)
    {
        $mentor = User::find($id);
        if(!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Found'
            ],404);
        }
        $mentor->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted'
        ]);
    }
}
