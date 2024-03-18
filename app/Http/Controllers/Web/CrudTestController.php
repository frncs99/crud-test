<?php

namespace App\Http\Controllers\Web;

use App\Actions\CrudTest\CrudTestService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrudTestController extends Controller
{
    /**
     * Class construct
     */
    public function __construct(CrudTestService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function index()
    {
        return;
    }
}
