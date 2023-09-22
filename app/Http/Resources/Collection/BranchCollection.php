<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'branch_name' => $branch->branch_name,
                    'address' => $branch->address,
                    'phone_no' => $branch->phone_no,
                    'opening_time' => $branch->opening_time,
                    'closing_time' => $branch->closing_time,
                    'is_active' => $branch->is_active,
                    'created_at' => (string)$branch->created_at,
                ];
            }),
        ];
    }
}
