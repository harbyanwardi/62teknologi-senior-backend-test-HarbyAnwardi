<?php

namespace App\Http\Controllers;

use App\Http\Resources\BusinessResource;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
       
        $business = new Business();
        $searchParams = $request->all();
        $data = $business->getBusinesses($searchParams);
        // return response()->json([
        //     'status' => true,
        //     'businesses' => $data
        // ], 200);
        return BusinessResource::collection($data);
    }

    public function show($id)
    {
        $business = new Business();
        $data = $business->getBusinessDetail($id);
        return response()->json([
            'code'  => 200,
            'status' => 'success',
            'data' => $data
        ],200);
    }
    

    public function store(Request $request)
    {
        $data_post = $request->json()->all();
        
        $business = new Business();
        $data_post = $request->json()->all();
        $validation = Validator::make($data_post, [
            'name' => 'required',
            'categories' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'coordinates' => 'required',
        ], [
            'required' => 'The :attribute field is required',
        ]);
        
        if($validation->fails()){
            return response()->json([
                'status' => false,
                'message' => $validation->messages()
            ], 400);
        }
        
        $base64_image = $data_post['image'];
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $filename = uniqid().".png";
            $data = base64_decode($data);
            Storage::disk('public')->put($filename, $data, 'public');
            // $data_post['image_url'] = $request->file('photo')->store(
            //     'images', 'public'
            // );
            $data_post['image_url'] = $filename;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Image Type',
            ], 400);
        }

        $data = $business->insertData($data_post);
        return response()->json([
            'status' => true,
            'message' => 'Business created successfully'
        ], 200);
    }

    
    public function update(Request $request, $id)
    {
        $data_post = $request->json()->all();

        $validation = Validator::make($data_post, [
            'name' => 'required',
            'categories' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'coordinates' => 'required',
        ], [
            'required' => 'The :attribute field is required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => $validation->errors()
            ], 400);
        }
        $business = Business::find($id);

        if (!$business) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Business not found',
            ], 400);
        }

        $base64_image = $data_post['image'];
        if(!empty($base64_image)) {
            if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
                $data = substr($base64_image, strpos($base64_image, ',') + 1);
                $filename = uniqid().".png";
                $data = base64_decode($data);
                Storage::disk('public')->put($filename, $data);
                $data_post['image_url'] = $filename;
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Image Type',
                ], 400);
            }
        }
        

        $business_model = new Business();
        $resp = $business_model->updateData($data_post,$id);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully Update Business',
        ], 200);
    }

    public function destroy($id)
    {
        $business = Business::find($id);
        if (!$business) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Business Not Found'
            ], 404);
        }
        $business->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully Deleted',

        ], 200);
    }
}
