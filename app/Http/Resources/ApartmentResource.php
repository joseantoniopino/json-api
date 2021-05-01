<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */

    public function toArray($request): array
    {
        return [
              'type' => 'apartment',
              'id' => $this->resource->getRouteKey(),
              'attributes' => [
                  'name' => $this->resource->name,
                  'description' => $this->resource->description,
                  'quantity' => $this->resource->quantity
              ],
              'links' => [
                  'self' => route('apartments.show', $this->resource)
              ]
        ];
    }
}
