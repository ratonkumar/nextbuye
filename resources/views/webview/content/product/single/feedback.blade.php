@php
    // ১. ডাটাবেজ থেকে ডাটা আনা
    $feedbackData = \App\Models\LandingPageSetting::where('section_key', 'feedback_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ২. ডাটা ডিকোড করা
    $feedback = $feedbackData ? json_decode($feedbackData->content, true) : [];
@endphp

@if($feedbackData)
<section style="background: rgb(30, 26, 21); padding: 80px 20px;">
    <div style="max-width: 800px; margin: 0px auto; text-align: center;">
        <div class="bn" style="font-weight:600;font-size:13px;letter-spacing:1px;text-transform:uppercase;color:#F0532B;margin-bottom:20px">{!! $feedback['feedback_subtitle'] ?? 'যাঁরা আমাদের ওপর আস্থা রেখেছেন' !!}</div>
        {!! $feedback['feedback_title'] ?? 'আমাদের সম্পর্কে গ্রাহকদের মতামত' !!}
        

        <div style=" padding: 20px; border-radius: 24px;box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            "{!! $feedback['feedback_descraption'] ?? 'এখানে গ্রাহকের মন্তব্যটি প্রদর্শিত হবে...' !!}"
            
            <div style="font-weight: 700; font-size: 16px; color: rgb(240, 83, 43);">
                — {!! $feedback['feedback_author'] ?? 'গ্রাহকের নাম' !!}
            </div>
        </div>

    </div>
</section>
@endif