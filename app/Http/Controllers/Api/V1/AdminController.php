<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\Colllection\AdminCollection;
use App\Models\Admin;
use App\Repository\Admin\AdminInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends BaseController
{
    protected $admin;
    public function __construct(AdminInterface $admin)
    {
        $this->admin = $admin;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', AdminCollection::make($this->admin->getAllData()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        ResponseHelper::sendSuccess('Admin Created Successfully', AdminResource::make($this->admin->storeOrUpdate($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', AdminResource::make($admin));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        ResponseHelper::sendSuccess('Admin Updated Successfully', AdminResource::make($this->admin->storeOrUpdate($request->validated(), $admin->id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $this->admin->delete($admin->id) ?
            ResponseHelper::sendSuccess('Admin Deleted Successfully')
            : ResponseHelper::sendError('Server Error', code: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
