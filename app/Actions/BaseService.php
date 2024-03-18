<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    /**
     * Model
     * 
     * @var object
     */
    protected $model;

    /**
     * Class construct
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * get record from the table using
     * the incremental id
     *
     * @return Model $model instance
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Retrieve all records from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * @return $this|bool
     */
    public function store($request, string $id = null)
    {
        if ($id !== null) {
            $this->model = $this->model->find($id);
            if (! $this->model) {
                return false;
            }
        }

        $fieldColumns = $this->model->getFillable();

        foreach ($fieldColumns as $column) {
            if ($request->has($column)) {
                $this->model[$column] = $request[$column];
            }
        }

        $this->model->save();

        return $this->model;
    }

    /**
     * @return array
     */
    public function delete(string $id)
    {
        $record = $this->model->find($id);
        if ($record) {
            return $record->delete();
        }

        return false;
    }
}