<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\ItemImage;
use App\Enums\PostTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory, HasUlids;

    protected $casts=[
        'post_type'=>PostTypeEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function itemImages(): HasMany
    {
        return $this->hasMany(ItemImage::class);
    }
}
