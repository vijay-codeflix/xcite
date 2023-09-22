
<?php

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Resources\AdminResource;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    Route::post('admin/login', [AuthController::class, 'adminLogin']);
    Route::post('employee/login', [AuthController::class, 'employeeLogin']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['middleware' => 'type.admin', 'prefix' => 'admin'], function () {
            Route::get('/user', function (Request $request) {
                return ResponseHelper::sendSuccess('Admin Detail', ['user' => AdminResource::make($request->user())]);
            });
            Route::apiResource('admins', AdminController::class);
            Route::get('logout', [AuthController::class, 'adminLogout']);

            Route::apiResource('employees', EmployeeController::class);
        });
        Route::group(['middleware' => 'type.employee', 'prefix' => 'employee'], function () {
            Route::get('/user', function (Request $request) {
                return ResponseHelper::sendSuccess('Employee Detail', ['user' => EmployeeResource::make($request->user())]);
            });
            Route::get('logout', [AuthController::class, 'employeeLogout']);
        });
    });
});
