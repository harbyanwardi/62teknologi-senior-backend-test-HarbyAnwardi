<?php

namespace App\Models;

use App\Http\Resources\BusinessResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Business extends Model
{
    //protected $table = 'businesses';
    use Sluggable;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\BusinessCategoryRelation');
    }

    public function coordinates()
    {
        return $this->hasOne('App\Models\BusinessesCoordinate')
            ->select('business_id', 'latitude', 'longitude');
    }

    public function location()
    {
        return $this->hasOne('App\Models\BusinessesLocation', 'business_id', 'id')->select(['business_id', 'address1', 'address2', 'address3', 'city', 'country', 'state', 'zip_code']);
    }

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'name'
            ]
        ];
    }

    public function getBusinesses($search)
    {
        $name = Arr::get($search, 'name', '');
        $sort = Arr::get($search, 'sort', '');
        $price_range = Arr::get($search, 'price_range', '');
        $latitude = Arr::get($search, 'latitude', '');
        $longitude = Arr::get($search, 'longitude', '');
        $limit = Arr::get($search, 'limit', '');
        $open_now = Arr::get($search, 'open_now', '');
        $category = Arr::get($search, 'category', '');

        $business = Business::query();
        $business->join('businesses_coordinates as coord', 'businesses.id', '=', 'coord.business_id');
        $business->join('business_category_relation as cat_rel', 'businesses.id', '=', 'cat_rel.business_id');
        $business->when($name, function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        });
        $business->when($price_range, function ($query) use ($price_range) {
            switch ($price_range) {
                case 0:
                    return $query->where('price', '>', 0);
                    break;
                case 10:
                    return $query->where('price', '>', 0)->where('price', '<=', 10000);
                    break;
                case 20:
                    return $query->where('price', '>=', 10000)->where('price', '<=', 30000);
                    break;
                case 30:
                    return $query->where('price', '>=', 30000)->where('price', '<=', 50000);
                    break;
                case 50:
                    return $query->where('price', '>=', 50000);
                    break;
            }
        });
        $business->when($latitude, function ($query) use ($latitude) {
            return $query->where('coord.latitude', $latitude);
        });
        $business->when($category, function ($query) use ($category) {
            return $query->where('cat_rel.category_id', $category);
        });
        $business->when($longitude, function ($query) use ($longitude) {
            return $query->where('coord.longitude', $longitude);
        });

        $business->when($open_now, function ($query) use ($open_now) {
            return $query->where('is_closed', '!=', $open_now);
        });

        $business->when($sort, function ($query) use ($sort) {
            return $query->orderBy('price', $sort);
        });

        $business->select('businesses.*', 'coord.latitude', 'coord.longitude');
        $business->groupBy('businesses.id');


        $limits = (!empty($limit)) ? $limit : 6;
        $data = $business->paginate($limits);
        //return new BusinessResource($data);
        return $business->paginate($limits);
        //return BusinessResource::collection($data);

    }

    public function getBusinessDetail($id)
    {
        $data = Business::query();
        $data->where('id', $id);
        return new BusinessResource($data->first());
    }

    public function getBusinessDetailSlug($slug)
    {
        $data = Business::query();
        $data->where('alias', $slug);
        return new BusinessResource($data->first());
    }

    public function insertData($data_post)
    {

        $data_business = array(
            "name" => $data_post['name'],
            // "alias" => Str::slug($data_post['name']),
            "phone" => $data_post['phone'],
            "distance" => $data_post['distance'],
            "is_closed" => $data_post['is_closed'],
            "price" => $data_post['price'],
            "rating" => $data_post['rating'],
            "review_count" => $data_post['review_count'],
            "image_url" => $data_post['image_url'],
            "transaction_url" => $data_post['transactions']

        );
        //insert business 
        $business = Business::create($data_business);
        $business_id = $business->id;

        //insert categories
        $categories = $data_post['categories'];

        for ($i = 0; $i < count($categories); $i++) {
            $data_categories = array(
                "business_id" => $business_id,
                "category_id" => $categories[$i]['category_id']
            );

            $category = BusinessCategoryRelation::create($data_categories);
        }


        //insert address
        $location = $data_post['location'];
        $data_location = array(
            "business_id" => $business_id,
            "address1" => $location['address1'],
            "address2" => $location['address2'],
            "address3" => $location['address3'],
            "city" => $location['city'],
            "country" => $location['country'],
            "state" => $location['state'],
            "zip_code" => $location['zip_code'],
        );
        $locations = BusinessesLocation::create($data_location);

        //coordinates
        $coordinate = $data_post['coordinates'];
        $data_coordinates = array(
            "business_id" => $business_id,
            "latitude" => $coordinate['latitude'],
            "longitude" => $coordinate['longitude'],
        );
        $coordinates = BusinessesCoordinate::create($data_coordinates);
    }

    public function updateData($data_post, $id)
    {
        $data_business = array(
            "name" => $data_post['name'],
            "alias" => Str::slug($data_post['name']),
            "phone" => $data_post['phone'],
            "distance" => $data_post['distance'],
            "is_closed" => $data_post['is_closed'],
            "price" => $data_post['price'],
            "rating" => $data_post['rating'],
            "review_count" => $data_post['review_count'],
            "image_url" => $data_post['image_url'],
            "transaction_url" => $data_post['transactions']

        );
        Business::where('id', $id)
            ->update($data_business);

        //update location
        $location = $data_post['location'];
        $data_location = array(

            "address1" => $location['address1'],
            "address2" => $location['address2'],
            "address3" => $location['address3'],
            "city" => $location['city'],
            "country" => $location['country'],
            "state" => $location['state'],
            "zip_code" => $location['zip_code'],
        );
        BusinessesLocation::where('business_id', $id)
            ->update($data_location);

        //update coord
        $coordinate = $data_post['coordinates'];
        $data_coordinates = array(
            "latitude" => $coordinate['latitude'],
            "longitude" => $coordinate['longitude'],
        );
        BusinessesCoordinate::where('business_id', $id)
            ->update($data_coordinates);

        $categories = $data_post['categories'];
        for ($i = 0; $i < count($categories); $i++) {
            $data_categories = array(
                "business_id" => $id,
                "category_id" => $categories[$i]['category_id']
            );
            //update category
            BusinessCategoryRelation::updateOrCreate(
                $data_categories,
                $data_categories
            );
        }
    }
}
