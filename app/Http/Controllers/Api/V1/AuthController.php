<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AdminLoginRequest;
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

        $request->session()->regenerate();
        ResponseHelper::sendSuccess('Login Successfully', UserResource::make(Auth::user()));
    }
}
