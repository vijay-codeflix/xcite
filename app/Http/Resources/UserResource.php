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
        $data = AdminResource::make(Auth::user());
        $token = $this->createToken("Token", ['role:admin'])->plainTextToken;
        return [
            'user' => $data,
            'token' => $token,
        ];
    }
}
