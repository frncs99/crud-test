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

    public function get()
    {
        return $this->model->get();
    }
}