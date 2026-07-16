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
<section style="background: rgb(250, 248, 245); padding: 80px 20px;">
    <div style="max-width: 800px; margin: 0px auto; text-align: center;">
        
        <h2 style="font-weight: 800; font-size: 32px; margin-bottom: 12px; color: rgb(30, 26, 21);">
            {{ $feedback['feedback_title'] ?? 'আমাদের সম্পর্কে গ্রাহকদের মতামত' }}
        </h2>
        
        <p style="font-size: 18px; color: rgb(138, 130, 120); margin-bottom: 40px;">
            {{ $feedback['feedback_subtitle'] ?? 'যাঁরা আমাদের ওপর আস্থা রেখেছেন' }}
        </p>

        <div style="background: #fff; padding: 40px; border-radius: 24px; border: 1px solid rgb(232, 224, 212); box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <p style="font-size: 20px; line-height: 1.8; color: rgb(30, 26, 21); font-style: italic; margin-bottom: 24px;">
                "{{ $feedback['feedback_descraption'] ?? 'এখানে গ্রাহকের মন্তব্যটি প্রদর্শিত হবে...' }}"
            </p>
            
            <div style="font-weight: 700; font-size: 16px; color: rgb(240, 83, 43);">
                — {{ $feedback['feedback_author'] ?? 'গ্রাহকের নাম' }}
            </div>
        </div>

    </div>
</section>
@endif