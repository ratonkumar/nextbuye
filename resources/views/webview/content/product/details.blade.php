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
<style>
    :root { --primary-color: #ff5722; --dark-bg: #1a1a1a; }
    .btn-custom { background: var(--primary-color); color: #fff; border-radius: 50px; padding: 15px 30px; font-weight: bold; }
    .section-padding { padding: 60px 0; }
    .feature-card { border: 1px solid #eee; padding: 20px; border-radius: 15px; background: #fff; }
</style>
<div class="container py-5">
        <div class="row justify-content-center g-4 mb-5">
            <div class="col-md-5">
                <div class="card p-4 border-0 shadow-sm h-100">
                    <h5 class="fw-bold">সস্তা চপার</h5>
                    <p class="text-muted small">যেটা কিনে বেশিদিন চলবে না</p>
                    <ul class="list-unstyled mt-3">
                        <li class="text-secondary mb-2">❌ মোটর: RPM কম, লেখাই থাকে না</li>
                        <li class="text-secondary mb-2">❌ ব্যাটারি: দুর্বল, অল্পদিনেই চার্জ ধরে না</li>
                        <li class="text-secondary mb-2">❌ ব্লেড: ৫-২টা, অল্প দিনেই ভোঁতা</li>
                        <li class="text-secondary mb-2">❌ নষ্ট হলে: ফোন ধরার কেউ নেই</li>
                        <li class="text-secondary mb-2">❌ পেমেন্ট: আগে টাকা, পরে ভাগা</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card p-4 border-2 border-orange shadow h-100 position-relative">
                    <span class="badge bg-orange position-absolute top-0 start-50 translate-middle">আপনি যা পাচ্ছেন</span>
                    <h5 class="fw-bold text-orange">CHOPLET™</h5>
                    <p class="text-muted small">প্রতিটা আসপেক্ট এক ধাপ এগিয়ে</p>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">✅ মোটর: ১৭০০ RPM — আদা, বাদামও থেমে যায় না</li>
                        <li class="mb-2">✅ ব্যাটারি: ৮০০mAh — USB-C — এক চার্জে বহুদিন</li>
                        <li class="mb-2">✅ ব্লেড: ৩টা ধারালো স্টেইনলেস স্টিল ব্লেড</li>
                        <li class="mb-2">✅ নষ্ট হলে: ৬ মাসের মধ্যে সমস্যা হলে নতুনটা পাঠাই</li>
                        <li class="mb-2">✅ পেমেন্ট: হাতে পেয়ে, চালিয়ে দেখে, তারপর টাকা</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 bg-dark text-white p-5 rounded-4 text-center">
                <p class="small text-uppercase mb-1">পুরনো নিয়মে যা খরচ হয়</p>
                <h2 class="display-4 fw-bold text-orange mb-3">৳২৪,০০০+</h2>
                <p class="text-secondary mb-5">প্রতি বছর — শুধু কুটাখুটির পেছনেই সময় আর রোজগার বেসাতো তো এর বাইরে।</p>
                
                <div class="row border-top border-secondary pt-4">
                    <div class="col-4">
                        <p class="text-secondary mb-0">বুয়া রাখলে</p>
                        <h5 class="fw-bold">৳২,০০০+</h5>
                        <small>প্রতি মাসে</small>
                    </div>
                    <div class="col-4 border-start border-secondary">
                        <p class="text-secondary mb-0">নিজে করলে</p>
                        <h5 class="fw-bold">৩০+ ঘণ্টা</h5>
                        <small>বছরে — পুরো আড়াই দিন</small>
                    </div>
                    <div class="col-4 border-start border-secondary">
                        <p class="text-secondary mb-0">রোজকার তেরদারি</p>
                        <h5 class="fw-bold">প্রতিদিন</h5>
                        <small>চোখ পানি, হাত জখম</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section class="section-padding bg-light">
    <div class="container text-center">
        <h2 class="mb-5">এক নজরে Choplet</h2>
        <div class="row">
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-coffee"></i><p>২৫০ ml</p></div></div>
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-bolt"></i><p>১৭০০ RPM</p></div></div>
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-battery-full"></i><p>৮০০ mAh</p></div></div>
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-cut"></i><p>Stainless Steel</p></div></div>
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-plug"></i><p>USB-C ক্যাবল</p></div></div>
            <div class="col-md-2 col-6"><div class="feature-card"><i class="fa fa-shield"></i><p>৬ মাস ওয়ারেন্টি</p></div></div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <h2 class="text-center mb-4">সচরাচর জিজ্ঞাসা</h2>
        <div class="accordion" id="faqAccordion">
            <div class="card">
                <div class="card-header">একবার চার্জে কতদিন চলে?</div>
                <div class="card-body">এটি ফুল চার্জে দীর্ঘ সময় ব্যাকআপ দেয়।</div>
            </div>
            <div class="card">
                <div class="card-header">পরিষ্কার করা কি ঝামেলার?</div>
                <div class="card-body">না, এর পার্টসগুলো সহজেই খোলা ও ধোয়া যায়।</div>
            </div>
            </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('path/to/choplet-main.jpg') }}" class="img-fluid rounded" alt="Choplet">
            </div>
            <div class="col-md-6">
                <span class="badge bg-warning text-dark">● নতুন লঞ্চ - প্রথম ১০০ পরিবার</span>
                <h1 class="fw-bold mt-2">CHOPLET™ — কর্ডলেস ইলেকট্রিক চপার</h1>
                <p class="lead">রোজ ১০ মিনিটের কাটাকুটি, চোখে পানি, হাতে জ্বলুনি — এবার সেটাই মাত্র ১০ সেকেন্ডে!</p>
                
                <div class="card p-3 my-3">
                    <ul class="list-unstyled mb-0">
                        <li>✓ ফ্রি ডেলিভারি - সারাদেশে</li>
                        <li>✓ ৬ মাস রিপ্লেসমেন্ট ওয়ারেন্টি</li>
                        <li>✓ ১০-সেকেন্ড চ্যালেঞ্জ — কাজ না করলে ফেরত, টাকা লাগবে না</li>
                    </ul>
                </div>
                
                <h2 class="text-danger fw-bold">৳৭৯০ <s class="text-muted fs-5">৳১৬৯০</s></h2>
                <button class="btn btn-lg btn-danger w-100 rounded-pill mt-3">অর্ডার করুন — টাকা হাতে পেয়ে দেবেন →</button>
                <button class="btn btn-outline-secondary w-100 rounded-pill mt-2">কল করে অর্ডার করুন: ০১৬৩৮-১৮৮৮৮৮</button>
            </div>
        </div>
    </div>
</section>
<!-- উপরের ডার্ক সেকশন -->
<section style="background-color: #1a1a1a; color: #fff; padding: 80px 20px; text-align: center;">
    <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 20px;">ভালো থাকা লুকিয়ে থাকে প্রতিদিনের ছোট ছোট মুহূর্তে</h2>
    <p style="color: #ccc; max-width: 600px; margin: 0 auto 20px;">আমরা চাই, আপনার প্রতিদিনের সাধারণ কাজগুলোও হোক সহজ, একটু সুন্দর। তাই আমরা যা বানাই, তাতে তাড়াহুড়ো থাকে না — শুধু "সস্তা" বানানোর জন্য আমরা কিছু বানাই না।</p>
    <p style="color: #fff; font-weight: bold;">সেই প্রিমিয়াম অনুভূতিটা শুধু কিছু মানুষের জন্য নয়, <span style="color: #ff5722;">এটা সবার প্রাপ্য।</span></p>
    
    <div style="margin-top: 40px; opacity: 0.7;">
        <h3 style="margin-bottom: 5px;">Stylify</h3>
        <p style="font-size: 14px;">Effortlessly elevated.</p>
    </div>
</section>

<!-- নিচের প্রোডাক্ট কার্ড -->
<section style="background-color: #fcfaf7; padding: 50px 20px;">
    <div class="container" style="background: #fff; border-radius: 20px; padding: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 900px;">
        <div class="row align-items-center">
            <div class="col-md-5">
                <img src="path/to/image.jpg" class="img-fluid" style="border-radius: 15px;">
            </div>
            <div class="col-md-7">
                <h4 style="font-weight: 800;">দিনে ৮৫.৫০ — আজ থেকে শুরু</h4>
                <p style="font-size: 14px; color: #666; margin-bottom: 15px;">প্রতিদিনের ছোট্ট একটা কাজে আজ থেকে সময় বাঁচান। এক টাকাও অগ্রিম নেই — হাতে পেয়ে, দেখে, তারপর টাকা দেবেন।</p>
                <div style="font-size: 28px; font-weight: 900; margin-bottom: 15px;">
                    ৳৭৯০ <s style="color: #888; font-size: 18px;">৳১৬৯০</s>
                </div>
                <button class="btn" style="background: #ff5722; color: #fff; padding: 12px 30px; border-radius: 30px; font-weight: bold;">অর্ডার করুন — টাকা হাতে পেয়ে দেবেন →</button>
            </div>
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
