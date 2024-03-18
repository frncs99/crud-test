<?php

namespace App\Http\Controllers\Web;

use App\Actions\CrudTest\CrudTestService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CrudTest\StoreRequest;
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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $crudTest = $this->modelService->get();

        return Inertia::render('CrudTest/Index', [
            'crudTest' => $crudTest,
        ]);
    }

    /**
     * Display the form for creating a new resource.
     *
     * @return \Inertia\Inertia
     */
    public function create()
    {
        return Inertia::render('CrudTest/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CrudTest\StoreRequest  $request
     * @return void
     */
    public function store(StoreRequest $request)
    {
        $this->modelService->store($request);

        session()->flash('message', __('messages.crud_test.success.store'));

        return;
    }
}
