<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'kost_name' => $this->kost_name,
            'location' => $this->location,
            'price' => $this->price,
            'owner' => $this->fullname,
        ];
    }
}
