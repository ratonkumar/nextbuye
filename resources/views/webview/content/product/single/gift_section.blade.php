

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
<section style="max-width: 820px; margin: 0px auto; padding: 20px 20px">
    <div
        class="reveal-s"
        style="
            background: rgb(250, 246, 240);
            border: 1.5px dashed rgb(240, 83, 43);
            border-radius: 22px;
            padding: 28px 26px;
            margin-top: 18px;
        "
    >
        <div style="display: flex; align-items: center; gap: 13px; margin-bottom: 18px">
            <span
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: rgb(240, 83, 43);
                    flex-shrink: 0;
                "
                ><svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path
                        d="M9.94 14.06A2 2 0 0 0 8.5 12.6l-5.1-1.32a.5.5 0 0 1 0-.96L8.5 9a2 2 0 0 0 1.44-1.44l1.32-5.1a.5.5 0 0 1 .96 0l1.32 5.1A2 2 0 0 0 15 9l5.1 1.32a.5.5 0 0 1 0 .96L15 12.6a2 2 0 0 0-1.46 1.46l-1.32 5.1a.5.5 0 0 1-.96 0z"
                    ></path>
                    <path d="M20 3v4"></path>
                    <path d="M22 5h-4"></path></svg
            ></span>
            <h3
                class="bh"
                style="font-weight: 800; font-size: 20px; line-height: 1.35; letter-spacing: -0.3px; margin: 0px"
            >
                {!!   $giftContent['gift_top_title'] ?? ''  !!}
                {{-- অর্ডার করলেই ফ্রি — <span style="color: rgb(178, 58, 24)">৳500+ মূল্যের ডিজিটাল গিফট</span> --}}
            </h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: 13px">
            @if(isset($giftContent['gift_top_rep']) && is_array($giftContent['gift_top_rep']))
            <div style="margin-bottom: 24px; text-align: left;">
                @foreach($giftContent['gift_top_rep'] as $item)
                    <div class="bn" style="display: flex; align-items: flex-start; gap: 11px; font-size: 15px; line-height: 1.6; color: rgb(58, 53, 46); margin-bottom: 10px;">
                        <span style="margin-top: 1px; flex-shrink: 0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F0532B" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        <span>{{ $item['title'] ?? 'এখানে টেক্সট দিন' }}</span>
                    </div>
                @endforeach
            </div>
            @endif
           
        </div>
        <div
            class="bn"
            style="
                margin-top: 18px;
                padding-top: 16px;
                border-top: 1px dashed rgb(232, 224, 212);
                font-size: 13px;
                color: rgb(107, 100, 90);
                display: flex;
                align-items: center;
                gap: 8px;
            "
        >
            <svg
                width="15"
                height="15"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#8A8278"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                style="display: block"
            >
                <rect x="1" y="6" width="13" height="10" rx="1"></rect>
                <path d="M14 9h4l3 3v4h-7z"></path>
                <circle cx="6" cy="18" r="2"></circle>
                <circle cx="17" cy="18" r="2"></circle></svg
            > {!!   $giftContent['gift_top_text'] ?? ''  !!}
        </div>
    </div>
</section>


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