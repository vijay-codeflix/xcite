<?php

namespace App\Repository\Employee;

use App\Models\Employee;

class EmployeeRepository implements EmployeeInterface
{

    public function getAllData()
    {
        return Employee::latest()->get();
    }
    public function storeOrUpdate($data, $id = null)
    {

        isset($data['password']) && $data['password'] = bcrypt($data['password']);
        return (is_null($id))
            ? Employee::create($data)
            : tap(Employee::find($id))->update($data);
    }
    public function view($id)
    {
        return Employee::find($id);
    }
    public function delete($id)
    {
        return Employee::find($id)->delete();
    }

    public function getByColumn($col, $data)
    {
        return Employee::where($col, $data)->latest('id')->first();
    }
}
