<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductSpecification extends Model
{
    use HasFactory, HasSlug;

    // ডাটাবেস টেবিলের সাথে কানেক্ট করার জন্য (যদি টেবিলের নাম আলাদা হয় তবেই এটি ব্যবহার করুন)
    // protected $table = 'product_specifications';

    // কোন কলামগুলো mass-assignable হবে তা ডিফাইন করুন
    protected $fillable = [
        'product_id', 
        'label', 
        'value', 
        'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('label') // 'label' থেকে স্লাগ তৈরি হবে
            ->saveSlugsTo('slug');
    }

    /**
     * প্রোডাক্টের সাথে রিলেশনশিপ (Inverse)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}