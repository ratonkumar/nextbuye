@php
    // ডাটাবেজ থেকে ডাটা নিয়ে আসা
    $faqData = \App\Models\LandingPageSetting::where('section_key', 'faq_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ডাটা ডিকোড করা
    $faqContent = $faqData ? json_decode($faqData->content, true) : null;
@endphp

@if($faqContent)
<section style="max-width: 820px; margin: 0px auto; padding: 0px 20px 80px">
    <h2 class="reveal bh" style="font-weight: 800; font-size: 36px; letter-spacing: -0.3px; margin: 0px 0px 28px">
        {{ $faqContent['faq_title'] ?? 'সচরাচর জিজ্ঞাসা' }}
    </h2>
    
    <div style="display: flex; flex-direction: column; gap: 12px">
        @if(isset($faqContent['faq_rep']) && is_array($faqContent['faq_rep']))
            @foreach($faqContent['faq_rep'] as $index => $item)
            <details class="reveal clp" 
                style="background: #fff; border: 1px solid #e8e0d4; border-radius: 16px; padding: 18px 22px;"
                {{ $index == 0 ? 'open' : '' }}> {{-- প্রথম আইটেমটি ডিফল্ট খোলা রাখার জন্য --}}
                
                <summary class="bh" style="font-weight: 600; font-size: 17.5px; cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; gap: 16px;">
                    {{ $faqContent['val'.$i] ?? '' }}
                    <span class="clp-plus" style="color: #f0532b; font-size: 22px; flex-shrink: 0; transition: transform 0.2s">+</span>
                </summary>
                
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #6b645a; margin: 14px 0px 0px">
                    {{ $item['answer'] }}
                </p>
            </details>
            @endforeach
        @endif
    </div>
</section>
@endif