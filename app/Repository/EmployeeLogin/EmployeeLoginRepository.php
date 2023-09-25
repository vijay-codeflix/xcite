<?php

namespace App\Repository\EmployeeLogin;

use App\Models\EmployeeLogin;

class EmployeeLoginRepository implements EmployeeLoginInterface
{

    public function getAllData()
    {
        return EmployeeLogin::latest()->get();
    }
    public function storeOrUpdate($data, $id = null)
    {
         return (is_null($id))
            ? EmployeeLogin::create($data)
            : tap(EmployeeLogin::find($id))->update($data);
    }
    public function view($id)
    {
        return EmployeeLogin::find($id);
    }
    public function delete($id)
    {
        return EmployeeLogin::find($id)->delete();
    }

    public function getByColumn($col, $data)
    {
        return EmployeeLogin::where($col, $data)->latest('id')->first();
    }
}
