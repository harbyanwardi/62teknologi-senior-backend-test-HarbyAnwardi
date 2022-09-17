<?php

namespace App\Http\Controllers;

use App\Kost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth; 

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        $userCurrent =  Auth::user();
        $kost = Kost::where('owner_id', '=', $userCurrent['id'])->get();
        

        return response()->json([
            'status' => 'success',
            'data' => $kost
        ]);

    }

    public function create(Request $request)
    {
        $rules = [
            'kost_name' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|integer',
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
       

        $userCurrent =  Auth::user();
        

        $insertData = array(
            "kost_name" => $data['kost_name'],
            "location" => $data['location'],
            "price" => $data['price'],
            "owner_id" => $userCurrent['id']
        );

        try { 
            $kost = Kost::create($insertData);
            return response()->json([
                'code' => 201,
                'status' => 'success',
                'data' => $kost,

            ],201);
          } catch(Exception $e) { 
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
          }

        
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'kost_name' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|integer',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $kost = Kost::find($id);

        if (!$kost) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Kost not found',
            ], 400);
        }

        $currentUser = Auth::user();
        if($currentUser['id'] != $kost->owner_id) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Only Owner Kost can update this kost',
            ], 400);
        }

        $updateData = array(
            "kost_name" => $data['kost_name'],
            "location" => $data['location'],
            "price" => $data['price']
        );
        
        $kost->fill($updateData);
        $kost->save();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $kost,
        ], 200);
    }

    public function destroy($id)
    {
        $kost = Kost::find($id);
        if(!$kost) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kost Not Found'
            ],404);
        }
        $kost->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Deleted',

        ],200);
    }
}
