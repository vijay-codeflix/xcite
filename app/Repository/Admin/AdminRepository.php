<?php

namespace App\Repository\Admin;

use App\Models\Admin;

class AdminRepository implements AdminInterface
{

    public function getAllData()
    {
        return Admin::latest()->get();
    }
    public function storeOrUpdate($data, $id = null)
    {
        isset($data['password']) && $data['password'] = bcrypt($data['password']);
        return (is_null($id))
            ? Admin::create($data)
            : tap(Admin::find($id))->update($data);
    }
    public function view($id)
    {
        return Admin::find($id);
    }
    public function delete($id)
    {
        return Admin::find($id)->delete();
    }

    public function getByColumn($col, $data)
    {
        return Admin::where($col, $data)->latest('id')->first();
    }
}
