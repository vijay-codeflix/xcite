<?php

namespace App\Repository\Branch;

interface BranchInterface
{
    public function getAllData();
    public function getAllDataQuery();
    public function storeOrUpdate($data, $id = null);
    public function view($id);
    public function destroy($id);
    public function getByColumn($col, $data);
}
