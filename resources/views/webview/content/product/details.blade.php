@extends('webview.master')

@section('maincontent')
@section('title')
    {{ env('APP_NAME') }}-{{ $productdetails->ProductName }}
@endsection

@section('meta')
    <meta name="description" content="{{ env('APP_NAME') }}-{{ $productdetails->ProductName }}">
    <meta name="keywords" content="arishatex, online store bd, online shop bd, Organic fruits, Thai, UK, Korea, China, cosmetics, Jewellery, bags, dress, mobile, accessories, automation Products,">


    <meta itemprop="name" content="{{ $productdetails->ProductName }}">
    <meta itemprop="description" content="{{ env('APP_NAME') }}-{{ $productdetails->ProductName }}">
    <meta itemprop="image" content="https://nextbuye.com/{{ $productdetails->ProductImage }}">

    <meta property="og:url" content="https://nextbuye.com/product/{{$productdetails->ProductSlug}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $productdetails->ProductName }}">
    <meta property="og:description" content="{{ env('APP_NAME') }}-{{ $productdetails->ProductName }}">
    <meta property="og:image" content="https://nextbuye.com/{{ $productdetails->ProductImage }}">
    <meta property="image" content="https://nextbuye.com/{{ $productdetails->ProductImage }}" />
    <meta property="url" content="https://nextbuye.com/product/{{$productdetails->ProductSlug}}">
    <meta itemprop="image" content="https://nextbuye.com/{{ $productdetails->ProductImage }}">
    <meta property="twitter:card" content="https://nextbuye.com/{{ $productdetails->ProductImage }}" />
    <meta property="twitter:title" content="{{ $productdetails->ProductName }}" />
    <meta property="twitter:url" content="https://nextbuye.com/product/{{$productdetails->ProductSlug}}">
    <meta name="twitter:image" content="https://nextbuye.com/{{ $productdetails->ProductImage }}">

    
<!-- এই ৫টি লাইন WhatsApp প্রিভিউ নিয়ে আসবে -->
    
@endsection
<style>
    .accordion-button:not(.collapsed) {
        color: #f97316;
        background-color: #fff !important;
        box-shadow: none;
    }
    .accordion-button::after {
        content: '+';
        background-image: none;
        font-size: 1.5rem;
    }
    .accordion-button:not(.collapsed)::after {
        content: '×'; /* ওপেন থাকলে ক্রস দেখাবে */
        background-image: none;
        transform: none;
    }
</style>
<style>
p {
    color: #555555;
    margin-bottom: 0px !important;
}
 @media screen and (max-width: 600px) {
            iframe {
                width: 100% !important;
            }
            
     }
    .sizetext {
        color: 000;
        background: #fff;
    }
    .colortext {
        color: #000;
        background: #fff;
    }
    .hov-shaddow.buy-now:hover {
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3) !important;
        border:1px solid #666 !important;
    }
    #sync2 .owl-stage .owl-item .items a img.w-100.h-100 {
          border:1px solid #666 !important;
    }
</style>
<!-- Body -->
<!-- Fancybox CSS -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />-->

<!-- jQuery (required) -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<!-- Fancybox JS -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>-->
<!--<a href="image.jpg" data-fancybox="gallery">-->
<!--  <img src="thumbnail.jpg" alt="Thumbnail" />-->
<!--</a>-->
<style>
</style>

<div class="container bg-light-cream">
    <div class="row">
        <!-- ইমেজ সেকশন -->
        <div class="col-md-6">
            <img src="{{ asset($productdetails->ProductImage) }}" class="img-fluid rounded" alt="Product">
            <div class="row mt-3">
                <div class="col-4"><img src="{{ asset($productdetails->ProductImage) }}" class="img-fluid rounded"></div>
                <!-- আরও ছোট থাম্বনেইল থাকলে এখানে যোগ করুন -->
            </div>
        </div>

        <!-- ডিটেইলস সেকশন -->
        <div class="col-md-6">
            <span class="badge" style="background:#fdebd0; color:#d35400;">● নতুন লঞ্চ - প্রথম ১০০ পরিবার</span>
            <h1 class="product-title">{{ $productdetails->ProductName }}</h1>
            <p class="highlight-text">রোজ ১০ মিনিটের কাটাকুটি, চোখে পানি, হাতে জ্বলুনি — এবার সেটাই মাত্র ১০ সেকেন্ডে!</p>
            
            <div class="offer-box">
                <ul class="list-unstyled">
                    <li>✓ ফ্রি ডেলিভারি - সারাদেশে</li>
                    <li>✓ ৬ মাস রিপ্লেসমেন্ট ওয়ারেন্টি</li>
                    <li>✓ ১০-সেকেন্ড চ্যালেঞ্জ — কাজ না করলে ফেরত, টাকা লাগবে না</li>
                </ul>
            </div>

            <div class="d-flex align-items-center mt-3">
                <span class="mr-3">নিয়মিত মূল্য <s>৳{{ intval($productdetails->ProductRegularPrice) }}</s></span>
                <span class="discount-badge">৳৭০০ সাশ্রয়</span>
            </div>
            <div class="price-box">৳{{ $productdetails->ProductSalePrice }}</div>

            <!-- Trust Box -->
            <div class="trust-box">
                <i class="fa fa-shield-alt"></i> <b>এখনি টাকা নয় — আগে টেস্ট, পরে পেমেন্ট</b><br>
                <small>প্রোডাক্ট হাতে পেয়ে, খুলে, ১০ সেকেন্ড চালিয়ে দেখে — তারপর টাকা দিন।</small>
            </div>

            <!-- Order Button -->
            <form action="{{url('add-to-cart')}}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                <button type="submit" class="order-btn">অর্ডার করুন — টাকা হাতে পেয়ে দেবেন →</button>
            </form>

            <a href="tel:01638188888" class="call-btn">
                <i class="fa fa-phone"></i> কল করে অর্ডার করুন: ০১৬৩৮-১৮৮৮৮৮
            </a>
        </div>
    </div>
</div>
<!-- উপরের আইকন সেকশন -->
@php
    // নির্দিষ্ট প্রোডাক্টের 'highlights_section' ডাটা নিয়ে আসা
    $highlightSection = \App\Models\LandingPageSetting::where('section_key', 'highlights_section')
                        ->where('product_id', $productdetails->id)
                        ->where('is_active', 1)
                        ->first();

    $highlights = $highlightSection ? json_decode($highlightSection->content, true) : null;
@endphp

@if($highlights)
<div class="container-fluid" style="background: #1a1a1a; padding: 40px 0; color: #fff;">
    <div class="container">
        <div class="row text-center">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-md-3">
                    <h2 style="color: #ff5722;">{{ $highlights['val'.$i] ?? '' }}</h2>
                    <p>{{ $highlights['label'.$i] ?? '' }}</p>
                </div>
            @endfor
        </div>
    </div>
</div>
@endif


@php
    $problemData = \App\Models\LandingPageSetting::where('section_key', 'problem_section')
                    ->where('product_id', $productdetails->id)
                    ->where('is_active', 1)
                    ->first();
    $p = $problemData ? json_decode($problemData->content, true) : [];
@endphp

@if($problemData)
<section class="problem-section" style="padding: 50px 0; background-color: #fcfaf7;">
    <div class="container">
        <p style="color: #d35400; font-weight: bold; margin-bottom: 5px;">
            {{ $p['story_title'] ?? 'প্রতিদিনের গল্প' }}
        </p>
        <h2 style="font-size: 32px; font-weight: 800; margin-bottom: 20px;">{{ $p['title'] ?? 'কাজগুলো ছোট, কিন্তু প্রতিদিন জমতে থাকে' }}</h2>
        <p style="margin-bottom: 40px; color: #555;">{{ $p['description'] ?? 'রান্নাঘরে যে সময়টা আপনি পরিবারের জন্য দেন, তার একটা বড় অংশ চলে যায় শুধু কাটাকুটিতেই।' }}</p>

        <div class="row">
                @for($i = 1; $i <= 4; $i++)
                <div class="col-md-3" @if($i == 1) style="margin-left: 0px;padding-left: 0px;" @endif>
                    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
                        <i class="fa fa-{{ $i==1 ? 'hand-paper' : ($i==2 ? 'tint' : ($i==3 ? 'fire' : 'clock')) }}" style="color: #ff5722; font-size: 30px; margin-bottom: 15px;"></i>
                        <h5>{{ $p['card'.$i.'_title'] ?? '' }}</h5>
                        <p style="font-size: 14px; color: #666;">{!! $p['card'.$i.'_desc'] ?? '' !!}</p>
                    </div>
                </div>
                @endfor
        </div>

        <div class="mt-5 p-4 text-white" style="background-color: #1a1a1a; border-radius: 10px; display: inline-block;">
            <h5 class="mb-0">
                {!! $p['footer_text'] ?? 'আমরা ধরেই নিয়েছি — “রান্না মানেই তো এই ঝক্কি”' !!} 
               
            </h5>
        </div>
    </div>
</section>
@endif
@php
    $comparisonData = \App\Models\LandingPageSetting::where('section_key', 'comparison_section')
                        ->where('product_id', $productdetails->id)
                        ->where('is_active', 1)
                        ->first();
    $c = $comparisonData ? json_decode($comparisonData->content, true) : [];
@endphp
@if($comparisonData)
<section style="padding: 50px 0; background-color:#fff">
    <div class="container text-center">
        {{-- ডাইনামিক টাইটেল --}}
         {!! $c['comparison_title'] ?? 'পার্থক্যটা <span style="color: #ff5722;">চোখে পড়ার মতো</span>' !!}

        <div class="row justify-content-center">
            <div class="col-md-5 p-4" style="background: #f4f1ed; border-radius: 15px; margin: 10px;">
                <div class="text-left">
                    {!! $c['comparison_left'] ?? '' !!}
                </div>
            </div>

            <div class="col-md-5 p-4" style="background: #1a1a1a; color: #fff; border-radius: 15px; margin: 10px;">
                <div class="text-left">
                    {!! $c['comparison_right'] ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@php
    // ডাটাবেজ থেকে product_features সেকশনের ডাটা আনুন
    $featureData = \App\Models\LandingPageSetting::where('section_key', 'product_features')
                        ->where('product_id', $productdetails->id)
                        ->where('is_active', 1)
                        ->first();
    
    $f = $featureData ? json_decode($featureData->content, true) : [];
    // ডিফল্ট ফিচার লিস্ট যদি ডাটা না থাকে
    $featuresList = $f['features_list'] ?? [];
@endphp

@if($featureData)
<section style="padding: 60px 0; background-color: #fcfaf7;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                @if(!empty($f['features_left_image']))
                    <img src="{{ asset($f['features_left_image']) }}" class="img-fluid" style="border-radius: 20px; width: 100%;" alt="Product Image">
                @endif
            </div>

            <div class="col-md-6">
                <p style="color: #d35400; font-weight: bold; margin-bottom: 5px;">{{ $f['sub_title'] ?? '' }}</p>
                <h2 style="font-size: 32px; font-weight: 800; margin-bottom: 30px;">{{ $f['title'] ?? '' }}</h2>

                @foreach($featuresList as $item)
                <div class="feature-card" style="background: #fff; padding: 20px; border-radius: 15px; margin-bottom: 15px; border: 1px solid #eee; display: flex; align-items: center;">
                    <i class="fa fa-check-circle" style="color: #ff5722; font-size: 24px; margin-right: 20px;"></i>
                    <div>
                        <h5 style="margin-bottom: 5px;">{{ $item['title'] ?? '' }}</h5>
                        <p style="font-size: 14px; color: #666; margin: 0;">{{ $item['subtitle'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@php
    // ডাটাবেজ থেকে 'product_functionality' সেকশনের ডাটা আনা
    $funcData = \App\Models\LandingPageSetting::where('section_key', 'product_functionality')
                    ->where('product_id', $productdetails->id)
                    ->where('is_active', 1)
                    ->first();
    
    $f = $funcData ? json_decode($funcData->content, true) : [];
    // এখানে স্টেপস এবং কন্ট্রোল ডাটা ধরা হচ্ছে
    $steps = $f['product_features_steps'] ?? []; 
@endphp
@if($funcData)
<section style="background-color: #1a1a1a; color: #fff; padding: 60px 0;">
    <div class="container text-center">
        {!! $f['product_sub_title'] ?? '' !!}
        {!! $f['product_title'] ?? '' !!}
        @if(!empty($f['product_main_image']))
            @php
                $extension = pathinfo($f['product_main_image'], PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'webm', 'ogg', 'mov'];
            @endphp

            @if(in_array(strtolower($extension), $videoExtensions))
                <video class="img-fluid mb-4" style="border-radius: 20px; max-width: 400px;" autoplay muted loop playsinline>
                    <source src="{{ asset($f['product_main_image']) }}" type="video/{{ $extension }}">
                    আপনার ব্রাউজার ভিডিওটি সাপোর্ট করছে না।
                </video>
            @else
                <img src="{{ asset($f['product_main_image']) }}" class="img-fluid mb-4" style="border-radius: 20px; max-width: 400px;">
            @endif
        @endif
        
        

        <div class="row justify-content-center">
            @foreach($steps as $index => $step)
            <div class="col-md-3">
                <div class="p-4" style="border: 1px solid {{ $index == 0 ? '#ff5722' : '#333' }}; border-radius: 15px; height: 100%;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div style="background: {{ $index == 0 ? '#ff5722' : '#333' }}; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            {{ $index + 1 }}
                        </div>
                        {{-- ডাইনামিক আইকন: ডাটাবেজে যদি 'icon_class' নামে কিছু থাকে --}}
                        <i class="{{ $step['icon_class'] ?? 'fas fa-blender' }}" style="color:rgb(240, 83, 43); font-size: 20px;"></i>
                    </div>
                    <h5 style="color:#fff; font-weight:bold; text-align:left ">{{ $step['title'] ?? '' }}</h5>
                    <p style="font-size: 14px; color: #ccc; text-align:left">{{ $step['subtitle'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 p-4" style="background: #252525; border-radius: 15px; max-width: 900px; margin: 0 auto; text-align: left; display: flex; align-items: center; justify-content: space-between;">
            
            <div style="flex: 1;">
                <h4 class="mb-3" style="color:#fff; font-weight:bold;">{{ $f['product_step_description'] ?? '' }}</h4>
                <p style="color: #ccc; margin-bottom: 20px;">{{ $f['product_bottom_feature'] ?? '' }}</p>
                <div class="d-flex gap-2">
                    <span class="btn" style="background: #ff5722; color: #fff; border-radius: 20px; padding: 5px 15px;">{{ $f['btn_1'] ?? '' }}</span>
                    <span class="btn" style="background: #333; color: #ccc; border-radius: 20px; padding: 5px 15px;">{{ $f['btn_2'] ?? '' }}</span>
                </div>
            </div>

            <div style="background: #1a1a1a; padding: 15px; border-radius: 10px; margin-left: 20px; min-width: 250px; border: 1px solid #333;">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($f['bottom_card_image'] ?? '') }}" style="width: 40px; margin-right: 10px;">
                    <div>
                        <h6 style="margin:0; color:#fff;">{{ $f['bottom_card_title'] ?? 'মোটা কুচি' }}</h6>
                        <small style="color:#ccc;">{{ $f['bottom_card_desc'] ?? 'সালাদ বা ভর্তায়...' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@php
    // ডাটাবেজ থেকে সেকশনের ডাটা আনা
    $lifestyleData = \App\Models\LandingPageSetting::where('section_key', 'interactive_card')
                        ->where('product_id', $productdetails->id)
                        ->where('is_active', 1)
                        ->first();
    
    $l = $lifestyleData ? json_decode($lifestyleData->content, true) : [];
@endphp

@if($lifestyleData)
<section style="padding: 60px 0; background-color: #fcfaf7;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="{{ asset($l['interactive_main_image'] ?? 'placeholder.jpg') }}" class="img-fluid" style="border-radius: 20px; width: 100%;    border-radius: 20px;
                    width: 83%;
                    height: 361px;
                    text-align: center;
                    display: block;
                    margin: 0px auto;" alt="Lifestyle">
            </div>
            <div class="col-md-6 p-4">
                <span style="font-size: 40px; color: #ff5722; font-weight: bold;">“</span>
                <h2 style="font-size: 28px; font-weight: 800; margin-bottom: 20px;">{{ $l['interactive_title'] ?? '' }}</h2>
                <p style="color: #555; line-height: 1.6;">{{ $l['interactive_step_description'] ?? '' }}</p>
            </div>
        </div>

        <div class="p-4 text-white" style="background-color: #1a1a1a; border-radius: 15px; max-width: 900px; margin: 0 auto;">
            <div class="d-flex align-items-center mb-3">
                <i class="fa fa-shield-alt" style="color: #ff5722; font-size: 24px; margin-right: 15px;"></i>
                <h4 class="mb-0" style="color: #fff;">{{ $l['interactive_features_steps'] ?? '' }}</h4>
            </div>
            <p style="margin-bottom: 10px;">{!! $l['interactive_bottom_feature'] ?? '' !!}</p>
            <p style="font-weight: bold; color: #ff5722;">{{ $l['payment_note'] ?? '' }}</p>
        </div>
    </div>
</section>
@endif
<section style="padding: 60px 0; background-color: #ffffff;">
    <div class="container">
        <!-- রেটিং সামারি -->
        <div class="d-flex align-items-center mb-5">
            <div class="mr-5 text-center">
                <h1 style="font-size: 60px; font-weight: 800; margin: 0;">4.8</h1>
                <div style="color: #f1c40f;">★★★★★</div>
                <p>৫৫০+ রিভিউ-এর গড়</p>
            </div>
            <div class="flex-grow-1">
                @foreach([5=>86, 4=>10, 3=>3, 2=>1, 1=>0] as $star => $percent)
                <div class="d-flex align-items-center mb-2">
                    <span class="mr-2">{{$star}} ★</span>
                    <div class="progress flex-grow-1" style="height: 8px; background: #eee; border-radius: 5px;">
                        <div class="progress-bar" style="width: {{$percent}}%; background: #e67e22;"></div>
                    </div>
                    <span class="ml-2" style="width: 40px;">{{$percent}}%</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- রিভিউ কার্ডস -->
        <div class="row">
            @for($i=1; $i<=6; $i++)
            <div class="col-md-4 mb-4">
                <div class="p-4" style="background: #fcfaf7; border-radius: 15px; border: 1px solid #f0f0f0;">
                    <div style="color: #f1c40f;" class="mb-2">★★★★★</div>
                    <p style="font-size: 15px; color: #333;">“প্রোডাক্টটি সত্যিই অসাধারণ। রসুন-আদা কয়েক সেকেন্ডেই কুচি হয়ে যায়, চোখে পানি আসার ভয় নেই!”</p>
                    <div class="d-flex align-items-center mt-3">
                        <div style="width: 40px; height: 40px; background: #e67e22; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 10px;">ত</div>
                        <div>
                            <h6 class="mb-0">তানভীর আহমেদ</h6>
                            <small style="color: #888;">✓ ভেরিফাইড · ঢাকা</small>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
<section style="max-width: 940px; margin: 0px auto; padding: 80px 20px 20px">
    <h2
        class="reveal bh"
        style="font-weight: 800; font-size: 33px; letter-spacing: -0.4px; text-align: center; margin: 0px 0px 10px"
    >
        সব চপার এক নয়।
    </h2>
    <p
        class="reveal bn"
        style="
            text-align: center;
            font-size: 16.5px;
            color: rgb(107, 100, 90);
            max-width: 560px;
            margin: 0px auto 36px;
            line-height: 1.75;
        "
    >
        বাজারে সস্তা চপারের অভাব নেই। কিন্তু পার্থক্যটা ঠিক কোথায় — নিজের চোখে মিলিয়ে নিন।
    </p>
    <div style="display: flex; flex-wrap: wrap; gap: 18px; align-items: stretch; justify-content: center">
        <div
            class="reveal"
            style="
                flex: 1 1 300px;
                max-width: 430px;
                background: rgb(247, 242, 234);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 24px;
                padding: 26px 24px;
            "
        >
            <div class="bh" style="font-weight: 700; font-size: 17px; color: rgb(107, 100, 90); margin-bottom: 3px">
                সস্তা চপার
            </div>
            <div class="bn" style="font-size: 12.5px; color: rgb(138, 130, 120); margin-bottom: 20px">
                যেটা কিনে বেশিরভাগ মানুষ পস্তায়
            </div>
            <div style="display: flex; flex-direction: column; gap: 15px">
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(234, 224, 208);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="10"
                            height="10"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#9a9183"
                            stroke-width="3.4"
                            stroke-linecap="round"
                        >
                            <path d="M6 6l12 12M18 6L6 18"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(138, 130, 120)"
                        ><b style="color: rgb(107, 100, 90); font-weight: 700">মোটর:</b> RPM কত, লেখাই থাকে না</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(234, 224, 208);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="10"
                            height="10"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#9a9183"
                            stroke-width="3.4"
                            stroke-linecap="round"
                        >
                            <path d="M6 6l12 12M18 6L6 18"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(138, 130, 120)"
                        ><b style="color: rgb(107, 100, 90); font-weight: 700">ব্যাটারি:</b> দুর্বল, কদিনেই চার্জ ধরে
                        না</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(234, 224, 208);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="10"
                            height="10"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#9a9183"
                            stroke-width="3.4"
                            stroke-linecap="round"
                        >
                            <path d="M6 6l12 12M18 6L6 18"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(138, 130, 120)"
                        ><b style="color: rgb(107, 100, 90); font-weight: 700">ব্লেড:</b> ১–২টা, অল্প দিনেই ভোঁতা</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(234, 224, 208);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="10"
                            height="10"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#9a9183"
                            stroke-width="3.4"
                            stroke-linecap="round"
                        >
                            <path d="M6 6l12 12M18 6L6 18"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(138, 130, 120)"
                        ><b style="color: rgb(107, 100, 90); font-weight: 700">নষ্ট হলে:</b> ফোন ধরার কেউ নেই</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(234, 224, 208);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="10"
                            height="10"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#9a9183"
                            stroke-width="3.4"
                            stroke-linecap="round"
                        >
                            <path d="M6 6l12 12M18 6L6 18"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(138, 130, 120)"
                        ><b style="color: rgb(107, 100, 90); font-weight: 700">পেমেন্ট:</b> আগে টাকা, পরে ভাগ্য</span
                    >
                </div>
            </div>
        </div>
        <div
            class="reveal lift"
            style="
                flex: 1 1 300px;
                max-width: 430px;
                background: rgb(255, 255, 255);
                border: 2px solid rgb(240, 83, 43);
                border-radius: 24px;
                padding: 26px 24px;
                box-shadow: rgba(240, 83, 43, 0.55) 0px 26px 50px -30px;
                position: relative;
            "
        >
            <div
                class="bn"
                style="
                    position: absolute;
                    top: -12px;
                    left: 24px;
                    background: rgb(240, 83, 43);
                    color: rgb(255, 255, 255);
                    font-weight: 700;
                    font-size: 11.5px;
                    padding: 4px 13px;
                    border-radius: 20px;
                "
            >
                আপনি যা পাচ্ছেন
            </div>
            <div class="bh" style="font-weight: 800; font-size: 18px; color: rgb(30, 26, 21); margin-bottom: 3px">
                CHOPLET™
            </div>
            <div class="bn" style="font-size: 12.5px; color: rgb(178, 58, 24); margin-bottom: 20px">
                প্রতিটা জায়গায় এক ধাপ এগিয়ে
            </div>
            <div style="display: flex; flex-direction: column; gap: 15px">
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(252, 233, 225);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="12"
                            height="12"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="3.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(47, 42, 36)"
                        ><b style="color: rgb(30, 26, 21); font-weight: 700">মোটর:</b> ১৭০০ RPM — আদা, বাদামও থেমে যায়
                        না</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(252, 233, 225);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="12"
                            height="12"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="3.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(47, 42, 36)"
                        ><b style="color: rgb(30, 26, 21); font-weight: 700">ব্যাটারি:</b> ৮০০mAh · USB-C — এক চার্জে
                        বহুদিন</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(252, 233, 225);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="12"
                            height="12"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="3.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(47, 42, 36)"
                        ><b style="color: rgb(30, 26, 21); font-weight: 700">ব্লেড:</b> ৩টা ধারালো স্টেইনলেস স্টিল
                        ব্লেড</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(252, 233, 225);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="12"
                            height="12"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="3.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(47, 42, 36)"
                        ><b style="color: rgb(30, 26, 21); font-weight: 700">নষ্ট হলে:</b> ৬ মাসের মধ্যে সমস্যা হলে
                        নতুনটা পাঠাই</span
                    >
                </div>
                <div style="display: flex; gap: 11px; align-items: flex-start">
                    <span
                        style="
                            flex-shrink: 0;
                            margin-top: 1px;
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: rgb(252, 233, 225);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        ><svg
                            width="12"
                            height="12"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="3.2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg></span
                    ><span class="bn" style="font-size: 14.5px; line-height: 1.55; color: rgb(47, 42, 36)"
                        ><b style="color: rgb(30, 26, 21); font-weight: 700">পেমেন্ট:</b> হাতে পেয়ে, চালিয়ে দেখে,
                        তারপর টাকা</span
                    >
                </div>
            </div>
        </div>
    </div>
    <div class="reveal" style="max-width: 700px; margin: 36px auto 0px; text-align: center">
        <p
            class="bh"
            style="
                font-weight: 800;
                font-size: 22px;
                line-height: 1.45;
                color: rgb(30, 26, 21);
                margin: 0px 0px 10px;
                letter-spacing: -0.3px;
            "
        >
            সস্তা বানানো কিন্তু কঠিন ছিল না।
        </p>
        <p class="bn" style="font-size: 16.5px; line-height: 1.8; color: rgb(107, 100, 90); margin: 0px">
            ছোট মোটর, দুর্বল ব্যাটারি, ওয়ারেন্টি ছেঁটে দিলেই দাম নেমে যেত। কিন্তু ঠকে যাওয়া একটা জিনিস আপনার হাতে তুলে
            দিতে চাইনি। তাই বাজিটা ধরেছি নিজেদের ওপর —
            <b style="color: rgb(30, 26, 21)">হাতে পেয়ে চালিয়ে দেখুন; ভালো না লাগলে একটা টাকাও দেবেন না।</b>
        </p>
    </div>
</section>

<section style="max-width: 820px; margin: 0px auto; padding: 80px 20px">
    <div class="reveal" style="text-align: center; margin-bottom: 30px">
        <span
            class="bn"
            style="
                display: inline-block;
                background: rgb(252, 233, 225);
                color: rgb(178, 58, 24);
                font-weight: 700;
                font-size: 12.5px;
                padding: 6px 14px;
                border-radius: 20px;
                margin-bottom: 15px;
            "
            >একটু হিসাব করে দেখি</span
        >
        <h2 class="bh" style="font-weight: 800; font-size: 31px; line-height: 1.3; letter-spacing: -0.4px; margin: 0px">
            কাটাকুটির পেছনে বছরে আসলে কত খরচ হয়?
        </h2>
    </div>
    <div
        class="reveal-s"
        style="
            background: rgb(30, 26, 21);
            color: rgb(250, 246, 240);
            border-radius: 26px;
            padding: 34px 28px;
            margin-bottom: 18px;
            box-shadow: rgba(30, 26, 21, 0.55) 0px 30px 60px -40px;
        "
    >
        <div
            class="bn"
            style="
                font-size: 12.5px;
                font-weight: 700;
                letter-spacing: 0.6px;
                text-transform: uppercase;
                color: rgb(229, 169, 143);
                margin-bottom: 16px;
                text-align: center;
            "
        >
            পুরনো নিয়মে যা খরচ হয়
        </div>
        <div style="text-align: center; margin-bottom: 6px">
            <span
                class="num"
                style="
                    font-weight: 800;
                    font-size: 60px;
                    line-height: 1;
                    color: rgb(255, 139, 99);
                    letter-spacing: -2.5px;
                "
                >৳24,000+</span
            >
        </div>
        <p
            class="bn"
            style="
                text-align: center;
                font-size: 15px;
                color: rgb(201, 191, 173);
                margin: 0px auto 28px;
                line-height: 1.65;
                max-width: 480px;
            "
        >
            প্রতি বছর — শুধু বুয়ার কাটাকুটির পেছনেই। সময় আর রোজকার ভোগান্তি তো এর বাইরে।
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(158px, 1fr)); gap: 12px">
            <div
                style="
                    background: rgb(38, 33, 26);
                    border: 1px solid rgb(52, 45, 36);
                    border-radius: 16px;
                    padding: 18px 16px;
                "
            >
                <div
                    style="display: flex; align-items: center; gap: 8px; margin-bottom: 11px; color: rgb(229, 169, 143)"
                >
                    <svg
                        width="17"
                        height="17"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display: block"
                    >
                        <path
                            d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0 0 4h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5"
                        ></path>
                        <path d="M16 12h.01"></path></svg>
                        <span class="bn" style="font-size: 12.5px; color: rgb(163, 154, 136)">বুয়া রাখলে</span>
                </div>
                <div
                    class="bh"
                    style="
                        font-weight: 800;
                        font-size: 23px;
                        color: rgb(255, 255, 255);
                        letter-spacing: -0.5px;
                        margin-bottom: 3px;
                    "
                >
                    ৳2,000+
                </div>
                <div class="bn" style="font-size: 12px; color: rgb(138, 130, 120); line-height: 1.45">প্রতি মাসে</div>
            </div>
            <div
                style="
                    background: rgb(38, 33, 26);
                    border: 1px solid rgb(52, 45, 36);
                    border-radius: 16px;
                    padding: 18px 16px;
                "
            >
                <div
                    style="display: flex; align-items: center; gap: 8px; margin-bottom: 11px; color: rgb(229, 169, 143)"
                >
                    <svg
                        width="17"
                        height="17"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display: block"
                    >
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path></svg>
                        <span class="bn" style="font-size: 12.5px; color: rgb(163, 154, 136)">নিজে করলে</span>
                </div>
                <div
                    class="bh"
                    style="
                        font-weight: 800;
                        font-size: 23px;
                        color: rgb(255, 255, 255);
                        letter-spacing: -0.5px;
                        margin-bottom: 3px;
                    "
                >
                    ৬০+ ঘণ্টা
                </div>
                <div class="bn" style="font-size: 12px; color: rgb(138, 130, 120); line-height: 1.45">
                    বছরে — পুরো আড়াই দিন
                </div>
            </div>
            <div
                style="
                    background: rgb(38, 33, 26);
                    border: 1px solid rgb(52, 45, 36);
                    border-radius: 16px;
                    padding: 18px 16px;
                "
            >
                <div
                    style="display: flex; align-items: center; gap: 8px; margin-bottom: 11px; color: rgb(229, 169, 143)"
                >
                    <svg
                        width="17"
                        height="17"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display: block"
                    >
                        <path
                            d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"
                        ></path></svg>
                        <span class="bn" style="font-size: 12.5px; color: rgb(163, 154, 136)">রোজকার ভোগান্তি</span>
                </div>
                <div
                    class="bh"
                    style="
                        font-weight: 800;
                        font-size: 23px;
                        color: rgb(255, 255, 255);
                        letter-spacing: -0.5px;
                        margin-bottom: 3px;
                    "
                >
                    প্রতিদিন
                </div>
                <div class="bn" style="font-size: 12px; color: rgb(138, 130, 120); line-height: 1.45">
                    চোখে পানি, হাতে জ্বালা
                </div>
            </div>
        </div>
    </div>
    <p
        class="reveal bn"
        style="text-align: center; font-size: 15.5px; color: rgb(107, 100, 90); margin: 0px 0px 40px; line-height: 1.7"
    >
        এই খরচটা প্রতি বছর ঘুরেফিরে আসে। <b style="color: rgb(30, 26, 21)">CHOPLET কিনতে হয় জীবনে একবারই।</b>
    </p>
    <div
        class="reveal-s"
        style="
            background: rgb(255, 255, 255);
            border: 1px solid rgb(232, 224, 212);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: rgba(30, 26, 21, 0.45) 0px 30px 60px -40px;
        "
    >
        <div style="height: 5px; background: linear-gradient(90deg, rgb(240, 83, 43), rgb(178, 58, 24))"></div>
        <div style="padding: 34px 26px">
            <div style="text-align: center; margin-bottom: 26px">
                <div class="bn" style="font-size: 14.5px; color: rgb(107, 100, 90); margin-bottom: 6px">
                    সব ঝামেলার একটাই সমাধান
                </div>
                <div class="bh" style="font-weight: 800; font-size: 24px; line-height: 1.25">
                    CHOPLET™ — একবার কিনলেই শেষ
                </div>
                <div style="display: flex; align-items: baseline; justify-content: center; gap: 12px; margin-top: 8px">
                    <span class="num" style="font-weight: 800; font-size: 46px; letter-spacing: -1.5px">৳990</span
                    ><span class="num" style="font-size: 20px; color: rgb(154, 145, 131); text-decoration: line-through"
                        >৳1,690</span
                    >
                </div>
            </div>
            <div
                style="
                    background: rgb(30, 26, 21);
                    border-radius: 20px;
                    padding: 26px 24px;
                    text-align: center;
                    margin-bottom: 26px;
                "
            >
                <div class="bn" style="font-size: 13.5px; color: rgb(184, 175, 159); margin-bottom: 6px">
                    ৬ মাসের ওয়ারেন্টি হিসাবে দাঁড়ায়
                </div>
                <div style="display: flex; align-items: baseline; justify-content: center; gap: 9px">
                    <span
                        class="bnum pop4"
                        style="
                            font-weight: 800;
                            font-size: 62px;
                            line-height: 1;
                            color: rgb(240, 83, 43);
                            letter-spacing: -2px;
                        "
                        >৳৫.৫০</span
                    ><span class="bn" style="font-size: 18px; color: rgb(250, 246, 240); font-weight: 600">/ দিন</span>
                </div>
                <p
                    class="bn"
                    style="
                        font-size: 14.5px;
                        line-height: 1.75;
                        color: rgb(217, 209, 194);
                        margin: 13px auto 0px;
                        max-width: 430px;
                    "
                >
                    <span class="bnum">৳৯৯০ ÷ ১৮০ দিন</span> — এক কাপ চায়ের চেয়েও কম। আর ৬ মাস পেরোলে? যতদিন চলবে,
                    প্রতিটা দিন একদম ফ্রি।
                </p>
            </div>
            <div
                style="border: 1px solid rgb(232, 224, 212); border-radius: 18px; overflow: hidden; margin-bottom: 16px"
            >
                <div
                    class="bn"
                    style="
                        background: rgb(251, 246, 239);
                        padding: 12px 18px;
                        font-size: 12.5px;
                        font-weight: 700;
                        color: rgb(107, 100, 90);
                        letter-spacing: 0.3px;
                    "
                >
                    অর্ডারে আপনি যা যা পাচ্ছেন
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 14px;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px solid rgb(232, 224, 212);
                    "
                >
                    <span
                        class="bn"
                        style="display: flex; align-items: center; gap: 9px; font-size: 14.5px; color: rgb(58, 53, 46)"
                        ><svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="2.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="flex-shrink: 0"
                        >
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                        CHOPLET™ কর্ডলেস চপার</span><span class="num" style="font-weight: 700; font-size: 14.5px; color: rgb(30, 26, 21)">৳1,490</span>
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 14px;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px solid rgb(232, 224, 212);
                    "
                >
                    <span
                        class="bn"
                        style="display: flex; align-items: center; gap: 9px; font-size: 14.5px; color: rgb(58, 53, 46)"
                        ><svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="2.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="flex-shrink: 0"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg>৬ মাস রিপ্লেসমেন্ট ওয়ারেন্টি</span
                    ><span style="display: flex; align-items: baseline; gap: 7px; white-space: nowrap"
                        ><span
                            class="num"
                            style="font-size: 13.5px; color: rgb(154, 145, 131); text-decoration: line-through"
                            >৳300</span
                        ><span class="bn" style="font-weight: 700; font-size: 13.5px; color: rgb(178, 58, 24)"
                            >ফ্রি</span
                        ></span
                    >
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 14px;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px solid rgb(232, 224, 212);
                    "
                >
                    <span
                        class="bn"
                        style="display: flex; align-items: center; gap: 9px; font-size: 14.5px; color: rgb(58, 53, 46)"
                        ><svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="2.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="flex-shrink: 0"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg
                        >সারাদেশে হোম ডেলিভারি</span
                    ><span style="display: flex; align-items: baseline; gap: 7px; white-space: nowrap"
                        ><span
                            class="num"
                            style="font-size: 13.5px; color: rgb(154, 145, 131); text-decoration: line-through"
                            >৳120</span
                        ><span class="bn" style="font-weight: 700; font-size: 13.5px; color: rgb(178, 58, 24)"
                            >ফ্রি</span
                        ></span
                    >
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 14px;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px solid rgb(232, 224, 212);
                    "
                >
                    <span
                        class="bn"
                        style="display: flex; align-items: center; gap: 9px; font-size: 14.5px; color: rgb(58, 53, 46)"
                        ><svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#F0532B"
                            stroke-width="2.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="flex-shrink: 0"
                        >
                            <path d="M20 6L9 17l-5-5"></path></svg
                        >ফ্রি ডিজিটাল বোনাস প্যাক</span
                    ><span style="display: flex; align-items: baseline; gap: 7px; white-space: nowrap"
                        ><span
                            class="num"
                            style="font-size: 13.5px; color: rgb(154, 145, 131); text-decoration: line-through"
                            >৳500</span
                        ><span class="bn" style="font-weight: 700; font-size: 13.5px; color: rgb(178, 58, 24)"
                            >ফ্রি</span
                        ></span
                    >
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 14px;
                        align-items: center;
                        padding: 12px 18px;
                        border-top: 1px dashed rgb(232, 224, 212);
                        background: rgb(252, 250, 246);
                    "
                >
                    <span class="bn" style="font-size: 14px; color: rgb(107, 100, 90)">মোট মূল্য</span
                    ><span class="num" style="font-size: 16px; color: rgb(154, 145, 131); text-decoration: line-through"
                        >৳2,410</span
                    >
                </div>
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        gap: 12px;
                        align-items: center;
                        padding: 16px 18px;
                        background: rgb(30, 26, 21);
                        color: rgb(255, 255, 255);
                        flex-wrap: wrap;
                    "
                >
                    <span class="bh" style="font-weight: 700; font-size: 15px">আজকের মূল্য</span
                    ><span style="display: flex; align-items: center; gap: 10px"
                        ><span
                            class="bn"
                            style="
                                font-size: 12px;
                                background: rgba(240, 83, 43, 0.2);
                                color: rgb(255, 199, 179);
                                font-weight: 700;
                                padding: 3px 9px;
                                border-radius: 10px;
                            "
                            >৳1,420 বাঁচল</span
                        ><span class="num" style="font-weight: 800; font-size: 27px; color: rgb(240, 83, 43)"
                            >৳990</span
                        ></span
                    >
                </div>
            </div>
            <div
                style="
                    display: flex;
                    align-items: center;
                    gap: 11px;
                    background: rgb(252, 233, 225);
                    border: 1px solid rgb(246, 215, 203);
                    border-radius: 14px;
                    padding: 12px 15px;
                    margin-bottom: 14px;
                "
            >
                <span
                    style="
                        width: 34px;
                        height: 34px;
                        border-radius: 10px;
                        background: rgb(255, 255, 255);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: rgb(240, 83, 43);
                        flex-shrink: 0;
                    "
                    ><svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display: block"
                    >
                        <path
                            d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"
                        ></path>
                        <path d="m9 12 2 2 4-4"></path></svg
                ></span>
                <div class="bn" style="font-size: 13.5px; line-height: 1.55; color: rgb(58, 53, 46)">
                    লঞ্চের <b style="color: rgb(178, 58, 24)">প্রথম ১০০ পরিবারের</b> একজন হয়ে যান — শুধু তাঁরাই পাচ্ছেন
                    পরের অর্ডারে <b style="color: rgb(178, 58, 24)">২০% ছাড়</b>।
                </div>
            </div>
            <div
                style="
                    background: rgb(251, 246, 239);
                    border: 1px solid rgb(232, 224, 212);
                    border-radius: 16px;
                    padding: 16px 16px 14px;
                    margin-bottom: 18px;
                "
            >
                <div
                    class="bn"
                    style="
                        text-align: center;
                        font-size: 12px;
                        font-weight: 700;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                        color: rgb(178, 58, 24);
                        margin-bottom: 12px;
                    "
                >
                    লঞ্চ অফার শেষ হতে বাকি
                </div>
                <div style="display: flex; gap: 7px; justify-content: center; align-items: center">
                    <div style="display: flex; align-items: center; gap: 7px">
                        <div
                            style="
                                min-width: 56px;
                                background: rgb(30, 26, 21);
                                border-radius: 12px;
                                padding: 9px 8px;
                                text-align: center;
                            "
                        >
                            <div
                                class="num"
                                style="
                                    font-weight: 800;
                                    font-size: 25px;
                                    line-height: 1;
                                    color: rgb(240, 83, 43);
                                    letter-spacing: -0.5px;
                                "
                            >
                                ০১
                            </div>
                            <div
                                class="bn"
                                style="
                                    font-size: 10px;
                                    color: rgb(163, 154, 136);
                                    margin-top: 4px;
                                    letter-spacing: 0.3px;
                                "
                            >
                                দিন
                            </div>
                        </div>
                        <span
                            class="num"
                            style="color: rgb(201, 190, 174); font-weight: 800; font-size: 18px; line-height: 1"
                            >:</span
                        >
                    </div>
                    <div style="display: flex; align-items: center; gap: 7px">
                        <div
                            style="
                                min-width: 56px;
                                background: rgb(30, 26, 21);
                                border-radius: 12px;
                                padding: 9px 8px;
                                text-align: center;
                            "
                        >
                            <div
                                class="num"
                                style="
                                    font-weight: 800;
                                    font-size: 25px;
                                    line-height: 1;
                                    color: rgb(240, 83, 43);
                                    letter-spacing: -0.5px;
                                "
                            >
                                ১১
                            </div>
                            <div
                                class="bn"
                                style="
                                    font-size: 10px;
                                    color: rgb(163, 154, 136);
                                    margin-top: 4px;
                                    letter-spacing: 0.3px;
                                "
                            >
                                ঘণ্টা
                            </div>
                        </div>
                        <span
                            class="num"
                            style="color: rgb(201, 190, 174); font-weight: 800; font-size: 18px; line-height: 1"
                            >:</span
                        >
                    </div>
                    <div style="display: flex; align-items: center; gap: 7px">
                        <div
                            style="
                                min-width: 56px;
                                background: rgb(30, 26, 21);
                                border-radius: 12px;
                                padding: 9px 8px;
                                text-align: center;
                            "
                        >
                            <div
                                class="num"
                                style="
                                    font-weight: 800;
                                    font-size: 25px;
                                    line-height: 1;
                                    color: rgb(240, 83, 43);
                                    letter-spacing: -0.5px;
                                "
                            >
                                ৩৩
                            </div>
                            <div
                                class="bn"
                                style="
                                    font-size: 10px;
                                    color: rgb(163, 154, 136);
                                    margin-top: 4px;
                                    letter-spacing: 0.3px;
                                "
                            >
                                মিনিট
                            </div>
                        </div>
                        <span
                            class="num"
                            style="color: rgb(201, 190, 174); font-weight: 800; font-size: 18px; line-height: 1"
                            >:</span
                        >
                    </div>
                    <div style="display: flex; align-items: center; gap: 7px">
                        <div
                            style="
                                min-width: 56px;
                                background: rgb(30, 26, 21);
                                border-radius: 12px;
                                padding: 9px 8px;
                                text-align: center;
                            "
                        >
                            <div
                                class="num"
                                style="
                                    font-weight: 800;
                                    font-size: 25px;
                                    line-height: 1;
                                    color: rgb(240, 83, 43);
                                    letter-spacing: -0.5px;
                                "
                            >
                                ০৭
                            </div>
                            <div
                                class="bn"
                                style="
                                    font-size: 10px;
                                    color: rgb(163, 154, 136);
                                    margin-top: 4px;
                                    letter-spacing: 0.3px;
                                "
                            >
                                সেকেন্ড
                            </div>
                        </div>
                    </div>
                </div>
                <p
                    class="bn"
                    style="text-align: center; font-size: 12.5px; color: rgb(107, 100, 90); margin: 12px 0px 0px"
                >
                    এই দাম শুধু <b style="color: rgb(178, 58, 24)">১৭ জুলাই ২০২৬</b> পর্যন্ত — এরপর ৳1,690।
                </p>
            </div>
            <button
                class="lift"
                style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 9px;
                    background: rgb(240, 83, 43);
                    color: rgb(255, 255, 255);
                    font-weight: 600;
                    font-size: 17.5px;
                    padding: 17px;
                    border-radius: 30px;
                    border-width: medium;
                    border-style: none;
                    border-color: currentcolor;
                    border-image: none;
                    cursor: pointer;
                    box-shadow: rgba(240, 83, 43, 0.6) 0px 10px 24px -10px;
                    width: 100%;
                "
            >
                অর্ডার করুন — টাকা হাতে পেয়ে দেবেন<svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                >
                    <path d="M5 12h14M13 6l6 6-6 6"></path>
                </svg>
            </button>
            <div
                class="bn"
                style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 7px;
                    font-size: 12.5px;
                    color: rgb(138, 130, 120);
                    margin-top: 13px;
                "
            >
                <svg
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#8A8278"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path
                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
                    ></path>
                    <path d="m9 12 2 2 4-4"></path></svg
                >এক টাকাও অগ্রিম নেই — হাতে পেয়ে, দেখে, তারপর পেমেন্ট।
            </div>
        </div>
    </div>
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
                অর্ডার করলেই ফ্রি — <span style="color: rgb(178, 58, 24)">৳500+ মূল্যের ডিজিটাল গিফট</span>
            </h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: 13px">
            <div
                class="bn"
                style="
                    display: flex;
                    align-items: flex-start;
                    gap: 11px;
                    font-size: 15px;
                    line-height: 1.6;
                    color: rgb(58, 53, 46);
                "
            >
                <span style="margin-top: 1px; flex-shrink: 0"
                    ><svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#F0532B"
                        stroke-width="2.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="flex-shrink: 0"
                    >
                        <path d="M20 6L9 17l-5-5"></path></svg></span
                ><span>৩০টি ঝটপট বাংলা রেসিপি (ভর্তা, বাটা মশলা, কিমা, বাচ্চার খাবার)</span>
            </div>
            <div
                class="bn"
                style="
                    display: flex;
                    align-items: flex-start;
                    gap: 11px;
                    font-size: 15px;
                    line-height: 1.6;
                    color: rgb(58, 53, 46);
                "
            >
                <span style="margin-top: 1px; flex-shrink: 0"
                    ><svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#F0532B"
                        stroke-width="2.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="flex-shrink: 0"
                    >
                        <path d="M20 6L9 17l-5-5"></path></svg></span
                ><span>রান্নার সময় বাঁচানোর ২০টি টিপস</span>
            </div>
            <div
                class="bn"
                style="
                    display: flex;
                    align-items: flex-start;
                    gap: 11px;
                    font-size: 15px;
                    line-height: 1.6;
                    color: rgb(58, 53, 46);
                "
            >
                <span style="margin-top: 1px; flex-shrink: 0"
                    ><svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#F0532B"
                        stroke-width="2.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="flex-shrink: 0"
                    >
                        <path d="M20 6L9 17l-5-5"></path></svg></span
                ><span>CHOPLET কেয়ার গাইড (পরিষ্কার, চার্জ, ব্লেডের যত্ন)</span>
            </div>
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
            >ডেলিভারির পর আপনার ইনবক্সে পাঠিয়ে দেওয়া হবে।
        </div>
    </div>
</section>
<section style="max-width: 900px; margin: 0px auto; padding: 40px 20px">
    <div
        class="reveal-s"
        style="
            background: rgb(30, 26, 21);
            color: rgb(250, 246, 240);
            border-radius: 28px;
            padding: 44px 34px;
            text-align: center;
        "
    >
        <h2
            class="bh"
            style="font-weight: 800; font-size: 27px; line-height: 1.35; letter-spacing: -0.3px; margin: 0px 0px 14px"
        >
            যিনি রোজ রাঁধেন — তাঁর হাত দুটোর কথা একবার ভাবুন।
        </h2>
        <p
            class="bn"
            style="
                font-size: 16.5px;
                line-height: 1.9;
                color: rgb(217, 209, 194);
                max-width: 580px;
                margin: 0px auto 26px;
            "
        >
            মা, স্ত্রী কিংবা বড় বোন — যে মানুষটা প্রতিদিন আপনার প্লেট ভরে রাখে, তার চোখের পানি আর হাতের জ্বালা বন্ধ করে
            দেওয়ার চেয়ে সুন্দর উপহার আর কী হতে পারে?
        </p>
        <a
            href="https://wa.me/8801302448888?text=%E0%A6%86%E0%A6%AE%E0%A6%BF%20Choplet%20%E0%A6%97%E0%A6%BF%E0%A6%AB%E0%A6%9F%20%E0%A6%95%E0%A6%B0%E0%A6%A4%E0%A7%87%20%E0%A6%9A%E0%A6%BE%E0%A6%87"
            target="_blank"
            rel="noopener noreferrer"
            class="lift"
            style="
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 9px;
                background: rgb(240, 83, 43);
                color: rgb(255, 255, 255);
                font-weight: 600;
                font-size: 16px;
                padding: 15px 32px;
                border-radius: 30px;
                border-width: medium;
                border-style: none;
                border-color: currentcolor;
                border-image: none;
                cursor: pointer;
                box-shadow: rgba(240, 83, 43, 0.6) 0px 10px 24px -10px;
                text-decoration: none;
            "
            >গিফট হিসেবে পাঠান<svg
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.4"
            >
                <path d="M5 12h14M13 6l6 6-6 6"></path></svg
        ></a>
    </div>
</section>
<section style="max-width: 1200px; margin: 0px auto; padding: 80px 20px">
    <h2 class="reveal bh" style="font-weight: 800; font-size: 36px; letter-spacing: -0.3px; margin: 0px 0px 32px">
        এক নজরে Choplet
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px">
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path d="M5 8h11v5a4 4 0 0 1-4 4H9a4 4 0 0 1-4-4z"></path>
                    <path d="M16 9h2a2 2 0 0 1 0 4h-2"></path>
                    <path d="M8 2v2M11 2v2"></path>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">ক্যাপাসিটি</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">২৫০ ml</div>
        </div>
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">মোটর স্পিড</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">১৭০০ RPM</div>
        </div>
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <rect x="2" y="7" width="16" height="10" rx="2"></rect>
                    <path d="M22 11v2"></path>
                    <path d="M11 9l-2 3h3l-2 3"></path>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">ব্যাটারি</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">৮০০ mAh · USB-C</div>
        </div>
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path d="M3 3v7c0 1.1.9 2 2 2a2 2 0 0 0 2-2V3"></path>
                    <path d="M5 12v9"></path>
                    <path d="M19 16V3a5 5 0 0 0-3 4.6V11a2 2 0 0 0 2 2h1zm0 0v5"></path>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">ব্লেড</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">৩টি Stainless Steel</div>
        </div>
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path d="M12 22v-5"></path>
                    <path d="M9 8V2"></path>
                    <path d="M15 8V2"></path>
                    <path d="M18 8v3a6 6 0 0 1-12 0V8z"></path>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">চার্জিং</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">USB-C কেবল</div>
        </div>
        <div
            class="reveal lift"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 20px;
                padding: 24px;
            "
        >
            <div
                style="
                    width: 46px;
                    height: 46px;
                    border-radius: 13px;
                    background: rgb(252, 233, 225);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                    color: rgb(240, 83, 43);
                "
            >
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    style="display: block"
                >
                    <path
                        d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
                    ></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </div>
            <div class="bn" style="font-size: 13px; color: rgb(138, 130, 120); margin-bottom: 4px">ওয়ারেন্টি</div>
            <div class="bh" style="font-weight: 700; font-size: 19px; line-height: 1.3">৬ মাস রিপ্লেসমেন্ট</div>
        </div>
    </div>
</section>
<section style="max-width: 820px; margin: 0px auto; padding: 0px 20px 80px">
    <h2 class="reveal bh" style="font-weight: 800; font-size: 36px; letter-spacing: -0.3px; margin: 0px 0px 28px">
        সচরাচর জিজ্ঞাসা
    </h2>
    <div style="display: flex; flex-direction: column; gap: 12px">
        <details
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                একবার চার্জে কতদিন চলে?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                একবার ফুল চার্জে বেশ কয়েকদিন অনায়াসে চলে। ফুরিয়ে গেলে USB-C দিয়ে চার্জ করে নিলেই আবার রেডি।
            </p>
        </details>
        <details
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                পরিষ্কার করা কি ঝামেলার?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                একদমই না। বাটি আর ব্লেড আলাদা করে খুলে সহজেই ধুয়ে ফেলতে পারবেন।
            </p>
        </details>
        <details
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                শক্ত জিনিস — আদা, বাদাম — পারবে?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                হ্যাঁ। একটু শক্ত কিছু হলে কয়েকবার চাপ দিলেই মিহি হয়ে যায়।
            </p>
        </details>
        <details
            open=""
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                Payment কখন করব?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                প্রোডাক্ট হাতে পেয়ে, খুলে, ১০ সেকেন্ড চালিয়ে দেখে — তারপর। পুরোটাই ক্যাশ অন ডেলিভারি।
            </p>
        </details>
        <details
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                কতদিনে ডেলিভারি পাব?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                ঢাকার ভেতরে ১–২ দিন, ঢাকার বাইরে ২–৪ দিন।
            </p>
        </details>
        <details
            class="reveal clp"
            style="
                background: rgb(255, 255, 255);
                border: 1px solid rgb(232, 224, 212);
                border-radius: 16px;
                padding: 18px 22px;
            "
        >
            <summary
                class="bh"
                style="
                    font-weight: 600;
                    font-size: 17.5px;
                    cursor: pointer;
                    list-style: none;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 16px;
                "
            >
                নষ্ট হলে কী হবে?<span
                    class="clp-plus"
                    style="color: rgb(240, 83, 43); font-size: 22px; flex-shrink: 0; transition: transform 0.2s"
                    >+</span
                >
            </summary>
            <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 14px 0px 0px">
                ৬ মাসের রিপ্লেসমেন্ট ওয়ারেন্টি আছে। কোনো যান্ত্রিক সমস্যা হলে বদলে দেব — নিশ্চিন্ত থাকুন।
            </p>
        </details>
    </div>
</section>
<section style="background: rgb(30, 26, 21); color: rgb(250, 246, 240)">
    <div class="reveal" style="max-width: 820px; margin: 0px auto; padding: 84px 20px; text-align: center">
        <div
            class="bn"
            style="
                font-weight: 600;
                font-size: 13px;
                letter-spacing: 1px;
                text-transform: uppercase;
                color: rgb(240, 83, 43);
                margin-bottom: 20px;
            "
        >
            কেন Stylify
        </div>
        <h2
            class="bh"
            style="font-weight: 800; font-size: 38px; line-height: 1.3; letter-spacing: -0.4px; margin: 0px 0px 26px"
        >
            ভালো থাকা লুকিয়ে থাকে প্রতিদিনের ছোট ছোট মুহূর্তে।
        </h2>
        <p class="bn" style="font-size: 17.5px; line-height: 1.95; color: rgb(184, 175, 159); margin: 0px 0px 18px">
            আমরা চাই, আপনার প্রতিদিনের সাধারণ কাজগুলোও হোক একটু সহজ, একটু সুন্দর। তাই আমরা যা বানাই, তাতে তাড়াহুড়ো
            থাকে না — শুধু “সস্তা” বানানোর জন্য আমরা কিছু বানাই না।
        </p>
        <p
            class="bh"
            style="color: rgb(255, 255, 255); font-weight: 600; font-size: 23px; line-height: 1.5; margin: 0px"
        >
            সেই প্রিমিয়াম অনুভূতিটা শুধু কিছু মানুষের জন্য নয়।
            <span style="color: rgb(240, 83, 43)">এটা সবার প্রাপ্য।</span>
        </p>
        <div style="margin-top: 40px; padding-top: 32px; border-top: 1px solid rgb(44, 38, 30)">
            <div class="num" style="font-weight: 800; font-size: 26px; letter-spacing: -0.5px">Stylify</div>
            <div
                style="
                    font-family: var(--font-hanken), sans-serif;
                    font-size: 15px;
                    color: rgb(163, 154, 136);
                    margin-top: 4px;
                "
            >
                Effortlessly elevated.
            </div>
        </div>
    </div>
</section>
<section style="max-width: 1100px; margin: 0px auto; padding: 80px 20px">
    <div
        class="reveal-s"
        style="
            background: rgb(255, 255, 255);
            border: 1px solid rgb(232, 224, 212);
            border-radius: 32px;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        "
    >
        <div
            style="
                flex: 1 1 320px;
                min-height: 340px;
                position: relative;
                overflow: hidden;
                background: rgb(241, 233, 220);
            "
        >
            <img
                alt="পরিবারের সাথে Choplet"
                loading="lazy"
                decoding="async"
                data-nimg="fill"
                class="object-cover"
                src="/landing/choplet/closing.webp"
                style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent"
            />
        </div>
        <div
            style="flex: 1 1 360px; padding: 48px 40px; display: flex; flex-direction: column; justify-content: center"
        >
            <h2
                class="bh"
                style="
                    font-weight: 800;
                    font-size: 30px;
                    line-height: 1.3;
                    letter-spacing: -0.3px;
                    margin: 0px 0px 14px;
                "
            >
                দিনে <span class="bnum">৳৫.৫০</span> — আজ থেকে শুরু।
            </h2>
            <p class="bn" style="font-size: 16.5px; line-height: 1.85; color: rgb(107, 100, 90); margin: 0px 0px 22px">
                প্রতিদিনের ছোট্ট একটা কাজ আজ থেকে সহজ হয়ে যাক। এক টাকাও অগ্রিম নেই — হাতে পেয়ে, দেখে, তারপর টাকা
                দেবেন।
            </p>
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 22px; flex-wrap: wrap">
                <span class="num" style="font-weight: 800; font-size: 38px">৳990</span
                ><span
                    class="num"
                    style="font-weight: 500; font-size: 20px; color: rgb(154, 145, 131); text-decoration: line-through"
                    >৳1,690</span
                ><span class="bn" style="font-size: 13px; color: rgb(138, 130, 120)">ফ্রি ডেলিভারি · COD</span>
            </div>
            <button
                class="lift"
                style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 9px;
                    background: rgb(240, 83, 43);
                    color: rgb(255, 255, 255);
                    font-weight: 600;
                    font-size: 17px;
                    padding: 17px 36px;
                    border-radius: 30px;
                    border-width: medium;
                    border-style: none;
                    border-color: currentcolor;
                    border-image: none;
                    cursor: pointer;
                    box-shadow: rgba(240, 83, 43, 0.6) 0px 10px 24px -10px;
                    align-self: flex-start;
                "
            >
                অর্ডার করুন — টাকা হাতে পেয়ে দেবেন<svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.4"
                >
                    <path d="M5 12h14M13 6l6 6-6 6"></path>
                </svg>
            </button>
        </div>
    </div>
</section>


{{-- modal for process and cart --}}
@section('subjs')
<!-- FancyBox CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


<script>
        $(document).ready(function() {
            $(".plus").click(function() {
                let input = $(this).siblings(".qty-input");
                let value = parseInt(input.val());
                input.val(value + 1);
                
                var qty = $('#qty_change').val();
        
                $('#qtyor').val(qty);
                $('#qtyorWeight').val(qty);
                
            });

            $(".minus").click(function() {
                let input = $(this).siblings(".qty-input");
                let value = parseInt(input.val());
                if (value > 1) {
                    input.val(value - 1);
                }
                
                var qty = $('#qty_change').val();
        
                $('#qtyor').val(qty);
                $('#qtyorWeight').val(qty);
            });
        });
    </script>
{{-- csrf --}}
<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<script>
    $(document).ready(function() {

        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
            ],
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                margin:6,
                items: slidesPerPage,
                dots: false,
                nav: true,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });


        $('#AddToCartForm').submit(function(e) {
            
            e.preventDefault();
            $('#processing').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            })
            $('#processing').modal('show');
            
            
            $.ajax({
                type: 'POST',
                url: '{{ url('add-to-cart') }}',
                processData: false,
                contentType: false,
                data: new FormData(this),

                success: function(data) {
                    updatecart();
                    $.ajax({
                        type: 'GET',
                        url: '{{ url('get-cart-content') }}',

                        success: function(response) {
                            $('#cartViewModal .modal-body').empty().append(
                                response);
                        },
                        error: function(error) {
                            console.log('error');
                        }
                    });
                    $('#processing').modal('hide');
                    $('#cartViewModal').modal('show');
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });

        $('#OrderNow').submit(function(e) {
            e.preventDefault();
            $('#processing').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            })
            $('#processing').modal('show');
            $.ajax({
                type: 'POST',
                url: '{{ url('add-to-cart') }}',
                processData: false,
                contentType: false,
                data: new FormData(this),

                success: function(data) {
                    updatecart();
                    if (data == 'success') {
                        window.location.href = 'https://nextbuye.com/checkout';
                        $('#processing').modal('hide');
                    }
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });


        // document.getElementById("istteb").click();
        $('#owl-single-product').owlCarousel({
            items: 1,
            itemsTablet: [768, 1],
            itemsDesktop: [1199, 1],
            autoplay: true,
            loop:true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,

        });
        $('#relatedCarousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 6,
                }
            }
        });
        $('#featuredCarousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 6,
                }
            }
        });

        $('#BestSelling').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            nav: true,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 6,
                }
            }
        });





    });

    // A $( document ).ready() block.
    $( document ).ready(function() {
        $('#description').addClass('active');
        $('#description').addClass('show');
    });
    
    function removeDesc() {
         $('#description').removeClass('active');
        $('#description').removeClass('show');
    }
    function getcolor(color) {
        $('#product_color').val(color);
         $('#product_color_bye').val(color);
        $('.colortext').css('color','#000');
        $('.colortext').css('background','#fff');
        $('#colortext'+color).css('color','#fff');
        $('#colortext'+color).css('background','#613EEA');
    }

    function getsize(size) {
        $('#product_size').val(size);
        $('#product_size_bye').val(size);
        $('.sizetext').css('color','#000');
        $('.sizetext').css('background','#fff');
        $('#sizetext'+size).css('color','#fff');
        $('#sizetext'+size).css('background','#613EEA');
    }
    
    
    $(document).on('change click keyup keydown', '#qty_change', function() {
        var qty = $('#qty_change').val();
        
        $('#qtyor').val(qty);
        $('#qtyorWeight').val(qty);
        //  $('#qtyor').val(qty);
       
    });
    function getweight(size, rgPrice, salePrice) {

        $('#product_weight').val(size);
        $('#product_weight_cart').val(size);
        
        
        $('#product_weight_salePrice').val(salePrice);
        $('#product_weight_regularPrice').val(rgPrice);
        
        $('#product_weight_salePrice_bye').val(salePrice);
        $('#product_weight_regularPric_byee').val(rgPrice);
        $('.weighttext').css('color','#000');
        $('.weighttext').css('background','#fff');
        $('#weightext'+size).css('color','#fff');
        $('#weightext'+size).css('background','#613EEA');
        $('#regularPrice').html(' ৳'+ rgPrice);
        $('#salePrice').html(' ৳ '+ salePrice);
    }

</script>

@endsection
@endsection
