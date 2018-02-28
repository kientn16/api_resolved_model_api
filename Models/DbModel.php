<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

trait DbModel
{

    public function getAll($columns = array('*'), $sortColumn = null, $direction = 'asc')
    {
        return $this->select($columns)->orderBy($sortColumn, $direction)->get();
    }

    public function findById($id, $columns = array('*'))
    {
        return $this->findOrFail($id, $columns);
    }

    public function updateObj(array $data, $id, $attribute="id")
    {
        return $this->where($attribute, '=', $id)->update($data);
    }

    public function findBy($key, $value)
    {
        return $this->where($key, $value)->first();
    }

    public function findAllByPagination($table, $skip = null, $take = null)
    {
        return $this->skip($skip)->take($take)->get();
    }

    public function findByAll($key, $value)
    {
        return $this->where($key, $value)->get();
    }

    /**
     * Get column in table
     * @return array
     */
    public function getColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
