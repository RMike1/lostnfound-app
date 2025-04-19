<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(4)->has(Item::factory()->count(5)->has(ItemImage::factory()->count(3))->for(User::factory()->create()))->create();
    }
}
