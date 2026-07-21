@php
    // ১. ডাটাবেজ থেকে রিভিউ সেকশনের ডাটা আনা
    $reviewsSectionData = \App\Models\LandingPageSetting::where('section_key', 'reviews_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ২. ডাটা ডিকোড করা (না থাকলে ডিফল্ট ভ্যালু বা অ্যারে ব্যবহার করা)
    $reviewsContent = $reviewsSectionData ? json_decode($reviewsSectionData->content, true) : [];

    // ৩. প্রয়োজনীয় ডাটা বা ডিফল্ট ফলব্যাক সেট করা
    $avgRating = $reviewsContent['average_rating'] ?? '4.8';
    $totalReviews = $reviewsContent['total_reviews'] ?? '150';
    $reviewData = $reviewsContent['ratings'] ?? ['5' => 86, '4' => 10, '3' => 3, '2' => 1, '1' => 0];
    $customerReviews = $reviewsContent['customer_reviews'] ?? [];
@endphp

@if($reviewsSectionData)
<section id="reviews" style="background: #fff; border-top: 1px solid #efe7db; border-bottom: 1px solid #efe7db">
    <div style="max-width: 1200px; margin: 0 auto; padding: 80px 20px">
        <div style="display: flex; flex-wrap: wrap; gap: 48px; align-items: center; margin-bottom: 44px">
            
            {{-- রেটিং সামারি --}}
            <div class="reveal" style="text-align: center">
                <div class="num" style="font-weight: 800; font-size: 72px; line-height: 1">{{ $avgRating }}</div>
                <div style="display: flex; justify-content: center; margin: 8px 0 6px">
                    <span style="display: flex; gap: 1px">
                        @for($i = 0; $i < 5; $i++)
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#F0A500" stroke="#F0A500" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </span>
                </div>
                <div class="bn" style="font-size: 14px; color: #8a8278">{{ $totalReviews }}+ রিভিউ-এর গড়</div>
            </div>

            {{-- রেটিং বার (লুপ) --}}
            <div class="reveal" style="flex: 1 1 280px; max-width: 420px; display: flex; flex-direction: column; gap: 9px">
                @foreach($reviewData as $star => $percentage)
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px">{{ $star }} ★</span>
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: {{ $percentage }}%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">{{ $percentage }}%</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- গ্রাহকদের রিভিউ লিস্ট (লুপ) --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 20px">
            @foreach($customerReviews as $review)
            <div class="reveal lift" style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px">
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px">
                        @for($i = 0; $i < ($review['rating'] ?? 5); $i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#F0A500" stroke="#F0A500" stroke-width="1.5" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                    </span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “{{ $review['title'] ?? '' }}”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bh" style="width: 44px; height: 44px; border-radius: 50%; background: {{ $review['bg_color'] ?? '#c98a4b' }}; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 17px; flex-shrink: 0;">
                        {{ $review['subtitle'] ?? '' }}
                    </span>
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">{{ $review['author_name'] ?? '' }}</div>
                        <div class="bn" style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#1B9B5A" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"></path></svg>
                            ভেরিফায়েড · {{ $review['icon'] ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif