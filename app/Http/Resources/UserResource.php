<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->route()->getActionMethod() == "adminLogin") {
            $data = AdminResource::make(Auth::user());
            $token = $this->createToken("Token", ['role:admin'])->plainTextToken;
        } else {
            $data = EmployeeResource::make(Auth::guard('employee')->user());
            $token = $this->createToken("Token", ['role:employee'])->plainTextToken;
        }
        return [
            'user' => $data,
            'token' => $token,
        ];
    }
}
