<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SaleDetailResource;
use App\Http\Resources\ClientResource;

class SaleResource extends JsonResource
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
            'id' => $this->id,
            'total' => $this->total,
            'client' => new ClientResource($this->client),
            'potions' =>PotionResource::collection($this->potions),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
