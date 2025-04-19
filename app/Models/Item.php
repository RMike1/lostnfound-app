<?php

namespace App\Models;

use App\Enums\PostTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory, HasUlids;

    protected $casts = [
        'post_type' => PostTypeEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function itemImages(): HasMany
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function scopeFiltered(Builder $q, $req): Builder
    {
        return $q->when($req->category, function ($q) use ($req) {
            $q->whereRelation('category', 'name', $req->category);
        });
    }
}
