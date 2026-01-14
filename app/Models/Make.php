<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    protected $fillable = [
        'name',
    ];

    public function modelTypes()
    {
        return $this->hasMany(ModelType::class, 'make_id');
    }
}
