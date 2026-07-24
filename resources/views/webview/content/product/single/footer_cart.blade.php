
<div
    style="
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        z-index: 60;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(12px);
        border-top: 1px solid rgb(232, 224, 212);
        box-shadow: rgba(30, 26, 21, 0.08) 0px -4px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 18px;
        transform: translateY(0px);
        transition: transform 0.3s cubic-bezier(0.2, 0.7, 0.2, 1);
        pointer-events: auto;
    "
    >
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
            <div class="bh order-title-fotter" style="font-weight: 700; font-size: 15px;">
                {{ $productdetails->ProductName }} — 
                <span class="num" style="font-weight: 800">৳{{ $productdetails->ProductSalePrice }}</span>
            </div>
            
        </div>
    </div>

    <button class="lift" 
            onclick="buynow('{{ $productdetails->id }}')"
            style="flex-shrink: 0; display: flex; align-items: center; gap: 8px; background: rgb(240, 83, 43); color: rgb(255, 255, 255); font-weight: 600; font-size: 15px; padding: 14px 26px; border-radius: 28px; border: none; cursor: pointer;">
        অর্ডার করুন
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
            <path d="M5 12h14M13 6l6 6-6 6"></path>
        </svg>
    </button>