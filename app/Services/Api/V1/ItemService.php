<?php

namespace App\Services\Api\V1;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Builder;

class ItemService
{
     /**
     * @param Request $req
     * @return array{0: ResourceCollection, 1: ResourceCollection}
     */
    public function index(Request $req): array
    {
        return [
            Category::get()->toResourceCollection(),
            Item::query()
                ->with(['category','user','itemImages' => fn($query) => $query->primaryImage()])
                ->filtered($req)
                ->latest()
                ->get()
                ->toResourceCollection(),
        ];
    }

    public function store($req): ItemResource
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
