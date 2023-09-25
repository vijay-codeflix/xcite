<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\Collection\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repository\Employee\EmployeeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class EmployeeController extends BaseController
{
    protected $employee;
    public function __construct(EmployeeInterface $employee)
    {
        $this->employee = $employee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', EmployeeCollection::make($this->employee->getAllData()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = 'EMP' . date('Ymd') . Str::random(5);
        ResponseHelper::sendSuccess('Employee Created Successfully', EmployeeResource::make($this->employee->storeOrUpdate($data)));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', EmployeeResource::make($employee));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        ResponseHelper::sendSuccess('Employee Created Successfully', EmployeeResource::make($this->employee->storeOrUpdate($request->validated(), $employee->id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->employee->delete($employee->id) ?
            ResponseHelper::sendSuccess('Employee Deleted Successfully')
            : ResponseHelper::sendError('Server Error', code: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
