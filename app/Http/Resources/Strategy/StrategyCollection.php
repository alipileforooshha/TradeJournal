<?php

namespace App\Http\Resources\Strategy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StrategyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pagination' => [
                'total' => $this->total(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem()
            ],
            'data' => $this->collection
        ];
    }
}
