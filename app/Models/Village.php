<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Village extends Model
{
    /** @use HasFactory<\Database\Factories\VillageFactory> */
    use HasFactory, HasUlids;

    public function cell(): BelongsTo
    {
        return $this->belongsTo(Cell::class);
    }
}
