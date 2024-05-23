<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Description extends Model
{
    use HasFactory;

    public function describable(): MorphTo
    {
        return $this->morphTo();
    }
}
