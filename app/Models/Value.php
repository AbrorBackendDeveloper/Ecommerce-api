<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Value extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name', 'added_price'];

    public function valueable(): BelongsTo
    {
        return $this->morphTo();
    }
}
