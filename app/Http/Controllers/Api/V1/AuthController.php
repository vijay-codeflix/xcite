<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\EmployeeLoginRequest;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use App\Repository\EmployeeLogin\EmployeeLoginInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Validation\Validator;

class AuthController extends BaseController
{

    protected $emp_login;
    public function __construct(EmployeeLoginInterface $emp_login)
    {
        $this->emp_login = $emp_login;
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        $request->authenticate();
        ResponseHelper::sendSuccess('Login Successfully', UserResource::make(Auth::user()));
    }
    public function adminLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        ResponseHelper::sendSuccess('Logout successfull');
    }
    public function employeeLogin(EmployeeLoginRequest $request)
    {
        $request->authenticate();
        $login = [
            'employee_id' => Auth::guard('employee')->user()->id,
            'branch_id' => $request->get('branch_id'),
            'ip' => request()->ip(),
        ];
        $this->emp_login->storeOrUpdate($login) &&
            ResponseHelper::sendSuccess('Login Successfully', UserResource::make(Auth::guard('employee')->user()));
    }
    public function employeeLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        ResponseHelper::sendSuccess('Logout successfull');
    }
    public function failedValidation(Validator $validator)
    {
        ResponseHelper::sendError('validation error', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
