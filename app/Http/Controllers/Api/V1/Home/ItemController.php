<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStoreRequest;
use App\Services\Api\V1\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(private ItemService $itemService) {}

    public function index(Request $req)
    {
        $data = $this->itemService->index($req);

        return response()->json([
            'category' => $data[0],
            'items' => $data[1],
        ], 200);
    }

    public function store(ItemStoreRequest $request)
    {
        return response()->json([$this->itemService->store($request)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
