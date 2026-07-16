@php
    $orderCtaData = \App\Models\LandingPageSetting::where('section_key', 'order_cta_section')
    ->where('product_id', $productdetails->id)
    ->where('is_active', 1)
    ->first();
    
    // ডাটা ডিকোড করা
    $cta = $orderCtaData ? json_decode($orderCtaData->content, true) : [];
@endphp
@if($orderCtaData)
<section style="max-width: 1100px; margin: 0px auto; padding: 80px 20px">
    <div class="reveal-s" style="background: rgb(255, 255, 255); border: 1px solid rgb(232, 224, 212); border-radius: 32px; overflow: hidden; display: flex; flex-wrap: wrap; align-items: stretch;">
        
        <div style="flex: 1 1 320px; min-height: 340px; position: relative; overflow: hidden; background: rgb(241, 233, 220);">
            <img alt="Choplet" loading="lazy" src="{{ asset($cta['order_cta_image'] ?? 'default-image.webp') }}" 
                 style="position: absolute; height: 100%; width: 100%; inset: 0px; object-fit: cover;" />
        </div>

        <div style="flex: 1 1 360px; padding: 48px 40px; display: flex; flex-direction: column; justify-content: center">
            <h2 style="font-weight: 800; font-size: 30px; line-height: 1.3; letter-spacing: -0.3px; margin: 0px 0px 14px;">
                {!! $cta['order_cta_title'] ?? 'দিনের মূল শিরোনাম' !!}
            </h2>
            
            <p style="font-size: 16.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 0px 0px 22px">
                {{ $cta['order_cta_subtitle'] ?? 'আপনার সাবটাইটেল এখানে...' }}
            </p>

            @php
                $regularPrice = intval($productdetails->ProductRegularPrice);
                $salePrice = intval($productdetails->ProductSalePrice);
                $savings = $regularPrice - $salePrice;
            @endphp

            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 22px; flex-wrap: wrap">
                <span style="font-weight: 800; font-size: 38px">৳{{ $salePrice }}</span>
                
                <span style="font-weight: 500; font-size: 20px; color: rgb(154, 145, 131); text-decoration: line-through">
                    ৳{{ $regularPrice }}
                </span>
                
                @if($savings > 0)
                    <span style="font-size: 13px; background: #fff0e0; color: #f0532b; padding: 2px 8px; border-radius: 4px; font-weight: bold;">
                        ৳{{ $savings }} সাশ্রয়
                    </span>
                @endif
                
                <span style="font-size: 13px; color: rgb(138, 130, 120)">ফ্রি ডেলিভারি · COD</span>
            </div>

            <button class="lift" style="display: flex; align-items: center; justify-content: center; gap: 9px; background: rgb(240, 83, 43); color: rgb(255, 255, 255); font-weight: 600; font-size: 17px; padding: 17px 36px; border-radius: 30px; border: none; cursor: pointer; box-shadow: rgba(240, 83, 43, 0.6) 0px 10px 24px -10px; align-self: flex-start;">
                {{ $cta['order_cta_button_text'] ?? 'অর্ডার করুন — টাকা হাতে পেয়ে দেবেন' }}
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                    <path d="M5 12h14M13 6l6 6-6 6"></path>
                </svg>
            </button>
        </div>
    </div>
</section>
@endif