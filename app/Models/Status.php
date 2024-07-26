<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'for',
        'code'
        ];
        
    public array $translatable = ['name'];
  
    
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
