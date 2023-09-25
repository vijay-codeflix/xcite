<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\Collection\BranchCollection;
use App\Models\branch;
use App\Repository\Branch\BranchInterface;
use Illuminate\Http\Response;

class BranchController extends BaseController
{
    protected $branch;
    public function __construct(BranchInterface $branch)
    {
        $this->branch = $branch;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', BranchCollection::make($this->branch->getAllData())->response()->getData());
    }

    public function store(BranchRequest $request)
    {
        ResponseHelper::sendSuccess('Branch Created Successfully', BranchResource::make($this->branch->storeOrUpdate($request->validated())));
    }

    /**
     * Display the specified resource.
     */
    public function show(branch $branch)
    {
        ResponseHelper::sendSuccess('Data Fetch Successfully', BranchResource::make($branch));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, branch $branch)
    {
        ResponseHelper::sendSuccess('Branch Updated Successfully', BranchResource::make($this->branch->storeOrUpdate($request->validated(), $branch->id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $this->branch->destroy($branch->id) ?
            ResponseHelper::sendSuccess('Branch Deleted Successfully')
            : ResponseHelper::sendError('Serve Error!', code: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
