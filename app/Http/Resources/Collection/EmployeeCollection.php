<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($employee) {
            return [
                'id' => $employee->id,
                'employee_id' => $employee->employee_id,
                'name' => $employee->name,
                'phone_no' => $employee->phone_no,
                'password' => $employee->password,
                'branch_id' => $employee->branch_id,
                'is_active' => $employee->is_active,
                'created_at' => (string)$employee->created_at,
            ];
        });
    }
}
