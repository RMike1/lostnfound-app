<?php

namespace App\Services\Api\V1;

use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemService
{
    public function index($req): array
    {
        return [
            Category::get()->toResourceCollection(),
            Item::with(['category', 'user', 'itemImages' => function ($q) {
                $q->take(1);
            }])->filtered($req)->latest()->get()->toResourceCollection(),
        ];
    }

    public function store($req)
    {
        $item = Item::create($req->safe()->except('itemImages'));
        if ($req->hasFile('itemImages')) {
            foreach ($req->file('itemImages') as $image) {
                $path = Storage::disk('public')->put('items_images', $image);
                $item->itemImages()->create([
                    'url' => $path,
                ]);
            }
        }

        return new ItemResource($item->load(['user', 'category', 'itemImages']));
    }
}
