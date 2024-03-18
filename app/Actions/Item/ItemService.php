<?php

namespace App\Actions\Item;

use App\Actions\BaseService;
use App\Models\Item;

class ItemService extends BaseService
{
    /**
     * Class construct
     */
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }
}