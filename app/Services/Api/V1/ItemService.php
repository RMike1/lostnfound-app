<?php

namespace App\Services\Api\V1;

use App\Models\Item;

class ItemService
{
    public function index()
    {
        return Item::with(['itemImages' => function($query) {
            $query->take(1);
        }])->latest()->get()->toResourceCollection();
    }
    public function store($req)
    {
        $item = Item::create($req->validated()->except('itemImages'));
        if($req->hasFile('itemImages')){
            foreach($req->file('itemImages') as $image){
                $path = $image->store('item_images');
                $item->itemImages()->create(['path' => $path]);
            }
        }
        return $item->toResource();
    }
}
