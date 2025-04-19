<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class ItemImage extends Model
{
    /** @use HasFactory<\Database\Factories\ItemImageFactory> */
    use HasFactory, HasUlids;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    #[Scope]
    public function primaryImage(Builder $query): void
    {
        $query->where('is_primary', true);
    }
}
