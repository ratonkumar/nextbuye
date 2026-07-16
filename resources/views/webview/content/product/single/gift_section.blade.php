@php
    // ডাটাবেজ থেকে ডাটা নিয়ে আসা
    $giftData = \App\Models\LandingPageSetting::where('section_key', 'product_gift_cart_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ডাটা ডিকোড করা
    $giftContent = $giftData ? json_decode($giftData->content, true) : null;
@endphp

@if($giftContent)
<section style="max-width: 900px; margin: 0px auto; padding: 40px 20px">
    <div class="reveal-s" style="background: rgb(30, 26, 21); color: rgb(250, 246, 240); border-radius: 28px; padding: 44px 34px; text-align: center;">
        
        <h2 class="bh" style="font-weight: 800; color:#fff; font-size: 27px; line-height: 1.35; letter-spacing: -0.3px; margin: 0px 0px 14px">
            {{ $giftContent['gift_title'] ?? 'গিফট শিরোনাম' }}
        </h2>
        
        <p class="bn" style="font-size: 16.5px;color:#fff;  line-height: 1.9; color: rgb(217, 209, 194); max-width: 580px; margin: 0px auto 26px;">
            {{ $giftContent['gift_descraption'] ?? 'গিফট ডেসক্রিপশন' }}
        </p>
        
        <a href="{{ $giftContent['gift_button_link'] ?? '#' }}" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="lift"
           style="display: inline-flex; align-items: center; justify-content: center; gap: 9px; background: rgb(240, 83, 43); color: rgb(255, 255, 255); font-weight: 600; font-size: 16px; padding: 15px 32px; border-radius: 30px; border: none; cursor: pointer; box-shadow: rgba(240, 83, 43, 0.6) 0px 10px 24px -10px; text-decoration: none;">
            {{ $giftContent['gift_Button_text'] ?? 'গিফট হিসেবে পাঠান' }}
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                <path d="M5 12h14M13 6l6 6-6 6"></path>
            </svg>
        </a>
    </div>
</section>
@endif