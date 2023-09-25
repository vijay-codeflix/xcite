<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BaseController extends Controller
{
    public $filter = array('id'); //searchable column (array)
    public $sort = array('id'); //sortable column (array)
    public $default_sort = '-id'; //by default sort 

    public $filter_model; //model required
    public function searchable()
    {
        try {
            return QueryBuilder::for($this->filter_model::class)
                ->allowedFilters($this->filter)
                ->defaultSort($this->default_sort)
                ->allowedSorts($this->sort);
        } catch (Exception $ex) {
            return $this->filter_model;
        }
    }

}