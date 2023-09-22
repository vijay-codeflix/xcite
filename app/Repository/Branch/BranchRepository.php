<?php

namespace App\Repository\Branch;

use App\Models\Branch;

class BranchRepository implements BranchInterface
{
    public function getAllData()
    {
        return Branch::latest()->get();
    }
    public function getAllDataQuery()
    {
        return Branch::query();
    }
    public function storeOrUpdate($data, $id = null)
    {
        return (is_null($id))
            ? Branch::create($data)->refresh()
            : tap(Branch::find($id))->update($data);
    }
    public function view($id)
    {
        return Branch::find($id);
    }
    public function destroy($id)
    {
        return Branch::find($id)->delete();
    }
    public function getByColumn($col, $data)
    {
        return Branch::where($col, $data)->latest('id')->first();
    }
}
