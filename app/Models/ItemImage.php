<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemImage extends Model
{
    /** @use HasFactory<\Database\Factories\ItemImageFactory> */
    use HasFactory, HasUlids;

    protected $fillable = ['item_id', 'url'];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
