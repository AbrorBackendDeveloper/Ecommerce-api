<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
        'icon'
    ];
    
    public array $translatable = ['name'];

    public function childCategories(): HasMany
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
    
    
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id','id');
    }
    

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
