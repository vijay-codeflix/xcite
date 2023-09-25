<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'name' => $this->name,
            'phone_no' => $this->phone_no,
            'branch_id' => $this->branch_id,
            'is_active' => $this->is_active,

            'created_at' => (string)$this->created_at,
        ];
    }
}
