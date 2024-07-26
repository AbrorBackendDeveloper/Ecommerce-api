<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'type',
        'values',
    ];

    public array $translatable = ['name'];

    public function values(): MorphMany
    {
        return $this->morphMany(Value::class, 'valueable');
    }
}
