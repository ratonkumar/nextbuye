<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSetting extends Model
{
    use HasFactory;

    // টেবিলের নাম (যদি ডিফল্ট নামের সাথে না মিলে)
    protected $table = 'landing_page_settings';

    // যে কলামগুলোতে ডাটা ইনসার্ট বা আপডেট করা যাবে
    protected $fillable = [
        'section_key',
        'content',
        'is_active'
    ];

    /**
     * content ফিল্ডটিকে JSON থেকে অ্যারেতে কনভার্ট করবে।
     * এতে করে আপনি $setting->content['title'] এভাবে সরাসরি ডাটা পেতে পারবেন।
     */
    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];
}