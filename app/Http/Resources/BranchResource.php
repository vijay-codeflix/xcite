<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'branch_name' => $this->branch_name,
            'address' => $this->address,
            'phone_no' => $this->phone_no,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'is_active' => $this->is_active,
            'created_at' => (string)$this->created_at,
        ];
    }
}
