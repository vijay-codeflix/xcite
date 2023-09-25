<?php

namespace App\Http\Requests;

use App\Helper\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = match (strtolower($this->method())) {
            'post' => [
                'name' => 'required|string|max:' . VALIDATION['MAX_STRING_LENGTH'],
                'email' => 'required|email|max:' . VALIDATION['MAX_EMAIL_LENGTH'] . '|unique:admins,email,NULL,id,deleted_at,NULL',
                'password' => 'required|string|min:' . VALIDATION['MIN_PASSWORD_LENGTH'],
            ],
            'patch', 'put' => [
                'name' => 'nullable|string|max:' . VALIDATION['MAX_STRING_LENGTH'],
                'email' => 'nullable|email|max:' . VALIDATION['MAX_EMAIL_LENGTH'] . '|unique:admins,email,' . $this->admin->id . ',id,deleted_at,NULL',
                'password' => 'nullable|string|min:' . VALIDATION['MIN_PASSWORD_LENGTH'],
            ],
            default => [],
        };
        return $rules;
    }
    public function validated($key = null, $default = null)
    {
        $validatedData = parent::validated();
        return array_filter($validatedData, function ($value) {
            return !is_null($value) && $value !== '';
        });
    }
    public function failedValidation(Validator $validator)
    {
        ResponseHelper::sendError('validation error', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
