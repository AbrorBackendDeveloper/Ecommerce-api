<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description'
    ];

    public array $translatable = ['name', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function withStock($stockId)
    {
        $this->stocks = [$this->stocks()->findOrFail($stockId)];
        return $this;
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    
    public function photos() : MorphMany
    {
        return $this->morphMany(Photo::class, 'photoable');
    }


    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function getDiscount()
    {
        if($this->discount){
            if($this->discount->from == null && $this->discount->to == null) {
                return $this->discount;
            } 
                if(Carbon::now()->between(Carbon::parse($this->discount->from), Carbon::parse($this->discount->to))) {
                    return $this->discount;
                }
                
            }
        }
}
