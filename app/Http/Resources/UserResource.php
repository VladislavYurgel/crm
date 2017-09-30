<?php

namespace App\Http\Resources;

class UserResource extends BaseApiResource
{
    /**
     * Transform request to the array
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}