<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function bigcategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function firstMedia()
    {
        return $this->morphOne(Media::class,'mediable');
    }

    public function media()
    {
        return $this->morphMany(Media::class,'mediable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tag');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class,'product_id');
    }

    public function scopeFeatured($q)
    {
        return $q->whereFeatured(true);
    }

    public function scopeActive($q)
    {
        return $q->whereStatus(true);
    }

    public function scopeQuantity($q)
    {
        return $q->where('quantity','>',0);
    }

    public function scopeActiveCategory($q)
    {
        return $q->whereHas('category' , function ($q){
            return $q->whereStatus(true);
        });
    }

    public function status()
    {
        return $this->status? 'Active' : "Inactive";
    }

    public function featuer()
    {
        return $this->featured ? 'Yes' : "No";
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

}
