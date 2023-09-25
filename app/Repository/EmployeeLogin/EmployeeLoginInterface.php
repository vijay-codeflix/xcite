<?php

namespace App\Repository\EmployeeLogin;

interface EmployeeLoginInterface
{

    public function getAllData();
    public function storeOrUpdate($data, $id = null);
    public function view($id);
    public function delete($id);
    public function  getByColumn($col, $data);
}
