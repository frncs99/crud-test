<?php

namespace App\Http\Controllers\Web;

use App\Actions\Item\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\DeleteRequest;
use App\Http\Requests\Item\StoreRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Class construct
     */
    public function __construct(ItemService $modelService)
    {
        $this->modelService = $modelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = $this->modelService->get();

        return Inertia::render('Item/Index', [
            'items' => $items,
        ]);
    }

    /**
     * Display the form for creating a new resource.
     *
     * @return \Inertia\Inertia
     */
    public function create()
    {
        return Inertia::render('Item/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Item\StoreRequest  $request
     * @return void
     */
    public function store(StoreRequest $request)
    {
        $this->modelService->store($request);

        session()->flash('message', __('messages.item.success.store'));

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Item\DeleteRequest  $request
     * @return \Illuminate\Http\Response|void
     */
    public function destroy(DeleteRequest $request)
    {
        $deleted = $this->modelService->delete($request->id);

        if (!$deleted) {
            return response(__('messages.item.failed.destroy'), 400);
        }

        session()->flash('message', __('messages.item.success.destroy'));

        return;
    }
}
