<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cell extends Model
{
    /** @use HasFactory<\Database\Factories\CellFactory> */
    use HasFactory, HasUlids;

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class);
    }
}
