<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Helper\ResponseHelper;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EmployeeLoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,employee_id,is_active,' . STATUS['ACTIVE'],
            'password' => 'required'
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::guard('employee')->attempt($this->only('employee_id', 'password'), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            ResponseHelper::sendError('validation error', ['employee_id' => __('auth.failed')], Response::HTTP_UNPROCESSABLE_ENTITY);

            // throw ValidationException::withMessages([
            //     'employee_id' => __('auth.failed'),
            // ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function messages()
    {
        return [
            'employee_id.exists' => __('auth.failed'),
        ];
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'employee_id' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('employee_id')) . '|' . $this->ip();
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        ResponseHelper::sendError('validation error', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
