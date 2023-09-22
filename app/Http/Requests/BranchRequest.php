<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BranchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request)
    {

        $method = strtolower($this->method());
        $rules = [];

        $rules = match ($method) {
            'post' => [
                'branch_name' => 'required|max:' . VALIDATION['MAX_LENGTH_STRING'] . '|unique:branches,branch_name,NULL,id,deleted_at,NULL',
                'address' => 'required|max:' . VALIDATION['MAX_LENGTH_ADDRESS'],
                'phone_no' => 'required|max:' . VALIDATION['MAX_LENGTH_PHONE'] . '|unique:branches,phone_no,NULL,id,deleted_at,NULL',
                'opening_time' => 'required',
                'closing_time' => 'required',
                'is_active' => 'nullable|in:' . STATUS['ACTIVE'] . ',' . STATUS['INACTIVE'],
            ],

            'patch', 'put' => [
                'branch_name' => 'nullable|max:' . VALIDATION['MAX_LENGTH_STRING'] . '|unique:branches,branch_name,' . $this->branch->id . ',id,deleted_at,NULL',
                'address' => 'nullable|max:' . VALIDATION['MAX_LENGTH_ADDRESS'],
                'phone_no' => 'nullable|max:' . VALIDATION['MAX_LENGTH_PHONE'] . '|unique:branches,phone_no,' . $this->branch->id . ',id,deleted_at,NULL',
                'opening_time' => 'nullable',
                'closing_time' => 'nullable',
                'is_active' => 'nullable|in:' . STATUS['ACTIVE'] . ',' . STATUS['INACTIVE'],
            ]
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

    protected function failedValidation(Validator $validator)
    {
        ResponseHelper::sendError('validation error', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
