<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    // ডাটাবেস টেবিলের নাম
    protected $table = 'sections';

    // Mass assignment এর জন্য ফিল্ডগুলো
    protected $fillable = [
        'key', 
        'content', 
        'is_active'
    ];
}