<?php

namespace App\Http\Controllers;

use App\Kost;
use App\LogAvailRoom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Exception;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $kost = Kost::query();
        
        $name = $request->query('name');
        $location = $request->query('location');
        $price_max = $request->query('price_max');
       
        $price_min = $request->query('price_min');

        if((!empty($price_max) && !is_numeric($price_max)) || (!empty($price_min) && !is_numeric($price_min))) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Range Price must be number'
            ],400);
        }
        $order = $request->query('order');
        
        
        $kost->when($name, function($query) use ($name) {
            return $query->where('kost_name', 'like', '%'. $name .'%');
        });
        $kost->when($location, function($query) use ($location) {
            return $query->where('location', 'like', '%'. $location .'%');
        });
        $kost->when($price_min, function($query) use ($price_min) {
            return $query->where("price", ">=", $price_min);
        });
        $kost->when($price_max, function($query) use ($price_max) {
            return $query->where("price", "<=", $price_max);
        });

        $kost->when($order, function($query) use ($order) {
            return $query->orderBy("price", $order);
        });


        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $kost->paginate(10)
        ],200);

    }

    public function detailKost($id)
    {
        $kost = Kost::query();
        $kost->join('users', 'users.id', '=', 'kost.owner_id');
        $kost->select('kost.kost_name','kost.location','kost.price','users.fullname as owner', 'kost.created_at as publish_date');
        $kost->where('kost.id', $id);
        if(!$kost) {
            return response()->json([
                'code'  => 400,
                'status' => 'error',
                'message' => 'Kost Not Found'
            ],400);
        }
        return response()->json([
            'code'  => 200,
            'status' => 'success',
            'data' => $kost->get()
        ],200);
    }

    public function askAvailabilityRoom(Request $request, $id)
    {
        $userCurrent =  Auth::user();
        $kost = Kost::find($id);
        if(!$kost) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kost Not Found'
            ],400);
        }

        $credit = $userCurrent['credit'];
        if($credit < 5) {
            return response()->json([
                'code'  => 400,
                'status' => 'error',
                'message' => 'Your Credit Isn\'t Enough'
            ],200);
        }
        $creditCurrent = $credit - 5;
        $data = array(
            "credit" => $creditCurrent
        );
        $user = User::find($userCurrent['id']);
        $user->fill($data);
        $user->save();

        $insertData = array(
            "customer_id" => $userCurrent['id'],
            "owner_id" => $kost->owner_id,
            "kost_id" => $kost->id,
            "message" => $request->input('message')
        );

        $log = LogAvailRoom::create($insertData);

        return response()->json([
            'code'  => 200,
            'status' => 'success',
            'credit' => $creditCurrent
        ],200);
    }
}
