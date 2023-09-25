<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\EmployeeLoginRequest;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

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
        ResponseHelper::sendSuccess('Login Successfully', UserResource::make(Auth::guard('employee')->user()));
    }
    public function employeeLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        ResponseHelper::sendSuccess('Logout successfull');
    }
}
