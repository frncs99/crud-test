<?php

namespace App\Actions\CrudTest;

use App\Actions\BaseService;
use App\Models\CrudTest;

class CrudTestService extends BaseService
{
    /**
     * Class construct
     */
    public function __construct(CrudTest $model)
    {
        parent::__construct($model);
    }
}