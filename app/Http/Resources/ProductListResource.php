<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'image' => $this->getFirstMediaUrl('images', 'small'),
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'department' => [
                'id' => $this->department?->id,
                'name' => $this->department?->name, 
            ],

        ];
    }
}
