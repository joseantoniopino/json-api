<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */

    public function toArray($request): array
    {
        return [
            'type' => $this->resource->getTable(),
            'id' => $this->resource->getRouteKey(),
            'attributes' => $this->resource->fields(),
            'relationships' => [
                'apartments' => [
                    'data' => $this->resource->getApartments()
                ]
            ],
            'links' => [
                'self' => route('api.v1.' . $this->resource->getTable() . '.show', $this->resource)
            ]
        ];
    }
}
