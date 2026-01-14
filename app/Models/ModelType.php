<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelType extends Model
{

    protected $fillable = [
        'name',
        'make_id',
    ];

    // This is the function Filament is looking for
    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class, 'make_id');
    }
}
