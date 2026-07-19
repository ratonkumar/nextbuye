@php
    $topSectionData = \App\Models\LandingPageSetting::where('section_key', 'product_top_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ডাটা ডিকোড করা
    $top = $topSectionData ? json_decode($topSectionData->content, true) : [];
@endphp
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

            {!! $productdetails->ProductDetails  !!}
            {{-- <p class="highlight-text">রোজ ১০ মিনিটের কাটাকুটি, চোখে পানি, হাতে জ্বলুনি — এবার সেটাই মাত্র ১০ সেকেন্ডে!</p>
            
            <div class="offer-box">
                <ul class="list-unstyled">
                    <li>✓ ফ্রি ডেলিভারি - সারাদেশে</li>
                    <li>✓ ৬ মাস রিপ্লেসমেন্ট ওয়ারেন্টি</li>
                    <li>✓ ১০-সেকেন্ড চ্যালেঞ্জ — কাজ না করলে ফেরত, টাকা লাগবে না</li>
                </ul>
            </div> --}}

         @php
            // নিয়মিত মূল্য এবং বিক্রয় মূল্যের পার্থক্য বের করা
            $regularPrice = intval($productdetails->ProductRegularPrice);
            $salePrice = intval($productdetails->ProductSalePrice);
            $savings = $regularPrice - $salePrice;
        @endphp

        <div style="margin-bottom: 12px">
            <div class="bn" style="font-size: 13px; color: #8a8278; margin-bottom: 3px; margin-top:10px">
                নিয়মিত মূল্য <span class="num" style="text-decoration: line-through">৳{{ $regularPrice}}</span>
            </div>
            <div style="display: flex; align-items: baseline; gap: 10px; flex-wrap: wrap">
                <span class="bn" style="font-size: 13.5px; font-weight: 600; color: #b23a18">আজকের অফার</span
                ><span class="num" style="font-weight: 800; font-size: 50px; line-height: 0.95; letter-spacing: -1px">৳{{ $salePrice}}</span
                ><span
                    class="bn"
                    style="
                        background: #f0532b;
                        color: #fff;
                        font-weight: 700;
                        font-size: 13px;
                        padding: 6px 12px;
                        border-radius: 20px;
                    "
                    >৳ {{ $savings}}
                    সাশ্রয়</span
                >
            </div>
        </div>


            <div
                class="reveal-s"
                style="
                    display: flex;
                    align-items: center;
                    gap: 18px;
                    background: #fce9e1;
                    border: 1px solid #f6d7cb;
                    border-radius: 18px;
                    padding: 16px 20px;
                    margin-bottom: 18px;
                "
            >
                <div style="text-align: center; flex-shrink: 0">
                    <div
                        class="bn"
                        style="
                            font-size: 10.5px;
                            font-weight: 700;
                            letter-spacing: 0.6px;
                            color: #b23a18;
                            text-transform: uppercase;
                            margin-bottom: 3px;
                        "
                    >
                        প্রতিদিন
                    </div>
                    <div class="bnum pop4" style="font-size: 42px; font-weight: 800; line-height: 0.9; color: #f0532b">৳৫.৫০</div>
                </div>
                <div style="border-left: 1px solid #eac9bb; padding-left: 18px">
                    <div
                        class="bh"
                        style="font-weight: 700; font-size: 16px; line-height: 1.35; color: #1e1a15; margin-bottom: 4px"
                    >
                        দিনে এক কাপ চায়ের চেয়েও কম
                    </div>
                    <div class="bn" style="font-size: 12.5px; line-height: 1.5; color: #6b645a">
                        ৬ মাসের ওয়ারেন্টি হিসাবে <span class="bnum">৳৯৯০ ÷ ১৮০</span> দিন
                    </div>
                </div>
            </div>

            <!-- Trust Box -->
            {{-- ডায়নামিক ডেইলি কস্ট সেকশন --}}
            <div class="reveal-s" style="display: flex; align-items: center; gap: 18px; background: #fce9e1; border: 1px solid #f6d7cb; border-radius: 18px; padding: 16px 20px; margin-bottom: 18px;">
                <div style="text-align: center; flex-shrink: 0">
                    <div class="bn" style="font-size: 10.5px; font-weight: 700; color: #b23a18;">{{ $top['daily_cost_label'] ?? 'প্রতিদিন' }}</div>
                    <div class="bnum pop4" style="font-size: 42px; font-weight: 800; line-height: 0.9; color: #f0532b">{{ $top['daily_cost_amount'] ?? '৳৫.৫০' }}</div>
                </div>
                <div style="border-left: 1px solid #eac9bb; padding-left: 18px">
                    <div class="bh" style="font-weight: 700; font-size: 16px; color: #1e1a15; margin-bottom: 4px">
                        {{ $top['daily_cost_title'] ?? 'দিনে এক কাপ চায়ের চেয়েও কম' }}
                    </div>
                    <div class="bn" style="font-size: 12.5px; color: #6b645a">
                        {{ $top['daily_cost_subtitle'] ?? '৬ মাসের ওয়ারেন্টি হিসাবে হিসাব' }}
                    </div>
                </div>
            </div>


                 <form id="orderForm" class="mt-3">
                    @csrf
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px; flex-wrap: wrap">
                    <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                    <div
                        style="
                            display: flex;
                            align-items: center;
                            border: 1px solid #e8e0d4;
                            border-radius: 30px;
                            background: #fff;
                            overflow: hidden;
                            flex-shrink: 0;
                        "
                    >
                  
                        <input type="hidden" name="qty" id="qtyInput" value="1">
                        <button type="button" onclick="changeQty(-1)" style="width: 44px; height: 30px; border: none; background: transparent; font-size: 22px; cursor: cell;color: #000;font-weight: bold;">−</button>
                        <span id="numDisplay" class="num" style="min-width: 30px; text-align: center; font-weight: 700; font-size: 17px">১</span>
                        <button type="button" onclick="changeQty(1)" style="width: 44px; height: 30px; border: none;color: #000; background: transparent; font-size: 20px; cursor: pointer;">+</button>

                        <script>
                            function changeQty(val) {
                                // ১. বর্তমান সংখ্যাটি নিন
                                let display = document.getElementById('numDisplay');
                                let hiddenInput = document.getElementById('qtyInput');
                                
                                // বাংলা সংখ্যাকে ইংরেজি সংখ্যায় রূপান্তরের জন্য ম্যাপ
                                let banglaToEnglish = {'১': 1, '২': 2, '৩': 3, '৪': 4, '৫': 5, '৬': 6, '৭': 7, '৮': 8, '৯': 9, '০': 0};
                                let englishToBangla = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                                
                                // ২. বর্তমান ভ্যালু ক্যালকুলেশন
                                let currentVal = parseInt(hiddenInput.value);
                                let newVal = currentVal + val;
                                
                                // ৩. সর্বনিম্ন ১ এর নিচে যেন না যায়
                                if (newVal < 1) newVal = 1;
                                
                                // ৪. আপডেট করুন
                                hiddenInput.value = newVal;
                                display.innerText = newVal.toString().split('').map(digit => englishToBangla[digit]).join('');
                            }
                        </script>
                    </div>
                        <button
                            class="lift"
                            style="
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                gap: 9px;
                                background: #f0532b;
                                color: #fff;
                                font-weight: 600;
                                font-size: 17px;
                                padding: 17px;
                                border-radius: 30px;
                                border: none;
                                cursor: pointer;
                                box-shadow: 0 10px 24px -10px rgba(240, 83, 43, 0.6);
                                flex: 1 1 200px;
                            "
                            onclick="buynowDetails('{{ $productdetails->id }}')"
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
                </form>


            <!-- ২. এইচটিএমএল-এ ডাটা বসান -->
            <a href="tel:{{ $shipping->phone_one }}" class="bn lift" style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 14.5px; font-weight: 700; color: #1e1a15; margin-bottom: 22px; text-decoration: none; padding: 12px; border: 1px solid #e8e0d4; border-radius: 30px; background: #fff;">
                <span style="color: #f0532b; display: flex">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9a16 16 0 0 0 6.91 6.91l.61-.61a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </span>
                কল করে অর্ডার করুন: <span style="color: #b23a18">{{ $shipping->phone_one }}</span>
            </a>

            <div
                style="
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 14px 20px;
                    padding-top: 22px;
                    border-top: 1px solid #e8e0d4;
                "
            >
                <div style="display: flex; align-items: center; gap: 11px">
                    <span
                        style="
                            width: 38px;
                            height: 38px;
                            border-radius: 11px;
                            background: #fce9e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-shrink: 0;
                            color: #f0532b;
                        "
                        ><svg
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="display: block"
                        >
                            <rect x="1" y="6" width="13" height="10" rx="1"></rect>
                            <path d="M14 9h4l3 3v4h-7z"></path>
                            <circle cx="6" cy="18" r="2"></circle>
                            <circle cx="17" cy="18" r="2"></circle></svg>
                        </span>
                    <div>
                        <div class="bn" style="font-weight: 600; font-size: 14px; line-height: 1.2">ফ্রি ডেলিভারি</div>
                        <div class="bn" style="font-size: 12px; color: #8a8278">সারাদেশে</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 11px">
                    <span
                        style="
                            width: 38px;
                            height: 38px;
                            border-radius: 11px;
                            background: #fce9e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-shrink: 0;
                            color: #f0532b;
                        "
                        ><svg
                            width="19"
                            height="19"
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
                            <path d="M16 12h.01"></path></svg></span>
                    <div>
                        <div class="bn" style="font-weight: 600; font-size: 14px; line-height: 1.2">ক্যাশ অন ডেলিভারি</div>
                        <div class="bn" style="font-size: 12px; color: #8a8278">হাতে পেয়ে পেমেন্ট</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 11px">
                    <span
                        style="
                            width: 38px;
                            height: 38px;
                            border-radius: 11px;
                            background: #fce9e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-shrink: 0;
                            color: #f0532b;
                        "
                        ><svg
                            width="19"
                            height="19"
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
                            <path d="m9 12 2 2 4-4"></path></svg></span>
                    <div>
                        <div class="bn" style="font-weight: 600; font-size: 14px; line-height: 1.2">৬ মাস ওয়ারেন্টি</div>
                        <div class="bn" style="font-size: 12px; color: #8a8278">রিপ্লেসমেন্ট</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 11px">
                    <span
                        style="
                            width: 38px;
                            height: 38px;
                            border-radius: 11px;
                            background: #fce9e1;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-shrink: 0;
                            color: #f0532b;
                        "
                        ><svg
                            width="19"
                            height="19"
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
                            <path d="m9 12 2 2 4-4"></path></svg>
                        </span>
                    <div>
                        <div class="bn" style="font-weight: 600; font-size: 14px; line-height: 1.2">১০০% অরিজিনাল</div>
                        <div class="bn" style="font-size: 12px; color: #8a8278">কোয়ালিটি গ্যারান্টি</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>