<?php

namespace App\Http\Controllers\Web;

use App\Actions\CrudTest\CrudTestService;
use App\Http\Controllers\Controller;
use App\Models\CrudTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudTestController extends Controller
{
    /**
     * Class construct
     */
    public function __construct(CrudTestService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function index(Request $request)
    {
        $crudTest = $this->modelService->get();

        return Inertia::render('CrudTest/Index', [
            'crudTest' => $crudTest,
        ]);
    }
}
