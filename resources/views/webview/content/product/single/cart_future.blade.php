@php
    // ডাটাবেজ থেকে ডাটা নিয়ে আসা
    $featureData = \App\Models\LandingPageSetting::where('section_key', 'product_features_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ডাটা ডিকোড করা
    $featureContent = $featureData ? json_decode($featureData->content, true) : null;
@endphp

@if($featureContent)
<section style="max-width: 1200px; margin: 0px auto; padding: 80px 20px">
    <h2 class="reveal bh" style="font-weight: 800; font-size: 36px; letter-spacing: -0.3px; margin: 0px 0px 32px">
        {{ $featureContent['features_title'] ?? 'এক নজরে' }}
    </h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px">
        @if(isset($featureContent['features_rep']) && is_array($featureContent['features_rep']))
            @foreach($featureContent['features_rep'] as $item1)
            <div class="reveal lift" style="background: #fff; border: 1px solid #e8e0d4; border-radius: 20px; padding: 24px;">
                <div style="width: 46px; height: 46px; border-radius: 13px; background: #fce9e1; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: #f0532b;">
                    {{-- এখানে আইকন হিসেবে SVG কোড বা HTML রেন্ডার হবে --}}
                    {!! $item1['icon'] ?? '' !!}
                </div>
                <div class="bn" style="font-size: 13px; color: #8a8278; margin-bottom: 4px">
                    {{ $item1['title'] ?? '' }}
                </div>
                <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">
                    {{ $item1['subtitle'] ?? '' }}
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>
@endif