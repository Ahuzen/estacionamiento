<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->createToken('token')->plainTextToken,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('d-m-Y')
        ];

    }
}
