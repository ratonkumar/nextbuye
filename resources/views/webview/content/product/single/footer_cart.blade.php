<div style="display: flex; align-items: center; gap: 12px; min-width: 0px">
    <div style="width: 46px; height: 46px; border-radius: 12px; background: radial-gradient(circle, rgb(244, 236, 224), rgb(230, 216, 196)); flex-shrink: 0; overflow: hidden; position: relative;">
        <img alt="{{ $productdetails->ProductName }}" 
             loading="lazy" 
             class="object-cover" 
             src="{{ asset($productdetails->ProductImage) }}" 
             style="position: absolute; height: 100%; width: 100%; inset: 0px; object-fit: cover;"
        />
    </div>

    <div style="min-width: 0px">
        <div class="bh" style="font-weight: 700; font-size: 15px; white-space: nowrap">
            {{ $productdetails->ProductName }} — 
            <span class="num" style="font-weight: 800">৳{{ $productdetails->ProductSalePrice }}</span>
            <span class="bn" style="font-size: 12px; color: rgb(138, 130, 120); font-weight: 500">· ফ্রি ডেলিভারি</span>
        </div>
        <div class="bn" style="font-size: 11.5px; color: rgb(178, 58, 24); font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            হাতে পেয়ে টেস্ট করে Payment
        </div>
    </div>
</div>

<button class="lift" 
        onclick="addtocart()"
        style="flex-shrink: 0; display: flex; align-items: center; gap: 8px; background: rgb(240, 83, 43); color: rgb(255, 255, 255); font-weight: 600; font-size: 15px; padding: 14px 26px; border-radius: 28px; border: none; cursor: pointer;">
    অর্ডার করুন
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
        <path d="M5 12h14M13 6l6 6-6 6"></path>
    </svg>
</button>