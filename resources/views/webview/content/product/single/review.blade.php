
@php
    // ডেটা ফেচিং (আগের লজিক অনুযায়ী)
    $reviewData = $top['ratings'] ?? ['5' => 86, '4' => 10, '3' => 3, '2' => 1, '1' => 0];
    $avgRating = $top['average_rating'] ?? '4.8';
    $totalReviews = $top['total_reviews'] ?? '150';
@endphp

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
    </div>
</section>
<section id="reviews" style="background: #fff; border-top: 1px solid #efe7db; border-bottom: 1px solid #efe7db">
    <div style="max-width: 1200px; margin: 0 auto; padding: 80px 20px">
        <div style="display: flex; flex-wrap: wrap; gap: 48px; align-items: center; margin-bottom: 44px">
            <div class="reveal" style="text-align: center">
                <div class="num" style="font-weight: 800; font-size: 72px; line-height: 1">4.8</div>
                <div style="display: flex; justify-content: center; margin: 8px 0 6px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <div class="bn" style="font-size: 14px; color: #8a8278">১৫০<!-- -->+ রিভিউ-এর গড়</div>
            </div>
            <div
                class="reveal"
                style="flex: 1 1 280px; max-width: 420px; display: flex; flex-direction: column; gap: 9px"
            >
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px"
                        >৫<!-- -->
                        ★</span
                    >
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: 86%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">86%</span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px"
                        >৪<!-- -->
                        ★</span
                    >
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: 10%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">10%</span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px"
                        >৩<!-- -->
                        ★</span
                    >
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: 3%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">3%</span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px"
                        >২<!-- -->
                        ★</span
                    >
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: 1%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">1%</span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span class="bn" style="font-size: 13px; color: #6b645a; width: 34px"
                        >১<!-- -->
                        ★</span
                    >
                    <div style="flex: 1; height: 8px; border-radius: 4px; background: #f1e7da; overflow: hidden">
                        <div style="height: 100%; width: 0%; background: #f0532b; border-radius: 4px"></div>
                    </div>
                    <span class="bn" style="font-size: 12px; color: #8a8278; width: 38px; text-align: right">0%</span>
                </div>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 20px">
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->প্রথমে ভেবেছিলাম এত ছোট জিনিসে কী আর হবে। কিন্তু রসুন-আদা সত্যিই কয়েক সেকেন্ডে কুচি হয়ে
                    যায়, চোখে পানি আসাও বন্ধ। ভালো লেগেছে।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #c98a4b;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >ত</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">তানভীর আহমেদ</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->ঢাকা
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->রান্নার সময় প্রায় অর্ধেকে নেমে এসেছে। চার্জও বেশ কয়েকদিন থাকে, রোজ চার্জ দিতে হয় না।
                    পরিবারের সবাই খুশি।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #9b6bb0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >ন</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">নুসরাত জাহান</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->চট্টগ্রাম
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->আম্মুর জন্য নিয়েছিলাম, এখন তো উনি এটা ছাড়া রান্নাই করতে চান না 😄 অর্ডারের ২ দিনের মধ্যেই
                    হাতে পেয়েছি।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #4b9b7a;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >র</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">রিফাত হোসেন</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->সিলেট
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->হাতে পেয়ে, খুলে দেখে তারপর টাকা দিয়েছি — কোনো ঝামেলা নেই। বাটি আর ব্লেড আলাদা করে ধোয়াও
                    সহজ। দামের তুলনায় কোয়ালিটি ভালো।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #5b8dbe;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >স</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">সাদিয়া ইসলাম</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->খুলনা
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->মরিচ কুচি করতে গিয়ে হাত জ্বলত, এখন সেই সমস্যা নেই। একটু শক্ত জিনিস হলে কয়েকবার চাপ দিতে
                    হয়, তবে কাজ ঠিকঠাক হয়।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #c2674b;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >ম</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">মাহমুদুল হাসান</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->রাজশাহী
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="reveal lift"
                style="background: #faf6f0; border: 1px solid #e8e0d4; border-radius: 22px; padding: 26px"
            >
                <div style="margin-bottom: 14px">
                    <span style="display: flex; gap: 1px"
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                        ><svg
                            width="14"
                            height="14"
                            viewBox="0 0 24 24"
                            fill="#F0A500"
                            stroke="#F0A500"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        >
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                            ></polygon></svg
                    ></span>
                </div>
                <p class="bn" style="font-size: 15.5px; line-height: 1.85; color: #3a352e; margin: 0 0 18px">
                    “<!-- -->অফিস থেকে ফিরে রান্না করতে হয়, এই জিনিসটা অনেকটা সময় বাঁচিয়ে দেয়। ছোট বলে রান্নাঘরে
                    জায়গাও লাগে না। রিকমেন্ড করব।<!-- -->”
                </p>
                <div style="display: flex; align-items: center; gap: 12px">
                    <span
                        class="bh"
                        style="
                            width: 44px;
                            height: 44px;
                            border-radius: 50%;
                            background: #8a6fb0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #fff;
                            font-weight: 700;
                            font-size: 17px;
                            flex-shrink: 0;
                        "
                        >ফ</span
                    >
                    <div>
                        <div class="bn" style="font-weight: 700; font-size: 14px">ফারজানা আক্তার</div>
                        <div
                            class="bn"
                            style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #8a8278"
                        >
                            <svg
                                width="13"
                                height="13"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#1B9B5A"
                                stroke-width="2.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"></path></svg
                            >ভেরিফায়েড ·
                            <!-- -->নারায়ণগঞ্জ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
