
@php
    // ডাটাবেজ থেকে ডাটা নিয়ে আসা
    $cartData = \App\Models\LandingPageSetting::where('section_key', 'product_cart_section')
        ->where('product_id', $productdetails->id)
        ->where('is_active', 1)
        ->first();
    
    // ডাটা ডিকোড করা
    $cartContent = $cartData ? json_decode($cartData->content, true) : null;
@endphp

@if($cartContent)
<section style="max-width: 900px; margin: 0px auto; padding: 40px 20px">
    <div class="reveal" style="text-align: center; margin-bottom: 30px">
        <span class="bn" style="display: inline-block; background: rgb(252, 233, 225); color: rgb(178, 58, 24); font-weight: 700; font-size: 12.5px; padding: 6px 14px; border-radius: 20px; margin-bottom: 15px;">
            {{ $cartContent['cart_top_sub_title'] ?? 'একটু হিসাব করে দেখি' }}
        </span>
        <h2 class="bh" style="font-weight: 800; font-size: 31px; line-height: 1.3; letter-spacing: -0.4px; margin: 0px">
            {{ $cartContent['cart_top_title'] ?? 'কাটাকুটির পেছনে বছরে আসলে কত খরচ হয়?' }}
        </h2>
    </div>

    <div class="reveal-s" style="background: rgb(30, 26, 21); color: rgb(250, 246, 240); border-radius: 26px; padding: 34px 28px; margin-bottom: 18px; box-shadow: rgba(30, 26, 21, 0.55) 0px 30px 60px -40px;">
        
        <div class="bn" style="font-size: 12.5px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; color: rgb(229, 169, 143); margin-bottom: 16px; text-align: center;">
            {{ $cartContent['cart_middle_title'] ?? 'পুরনো নিয়মে যা খরচ হয়' }}
        </div>
        
        <div style="text-align: center; margin-bottom: 6px">
            <span class="num" style="font-weight: 800; font-size: 60px; line-height: 1; color: rgb(255, 139, 99); letter-spacing: -2.5px;">
                {{ $cartContent['cart_middle_count'] ?? '৳24,000+' }}
            </span>
        </div>
        
        <p class="bn" style="text-align: center; font-size: 15px; color: rgb(201, 191, 173); margin: 0px auto 28px; line-height: 1.65; max-width: 480px;">
            {{ $cartContent['cart_middle_text'] ?? 'প্রতি বছর — শুধু বুয়ার কাটাকুটির পেছনেই। সময় আর রোজকার ভোগান্তি তো এর বাইরে।' }}
        </p>

        {{-- রিপিটার সেকশন --}}
        @if(isset($cartContent['cart_middle_repeter']) && is_array($cartContent['cart_middle_repeter']))
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(158px, 1fr)); gap: 12px">
            @foreach($cartContent['cart_middle_repeter'] as $item2)
            <div style="background: rgb(38, 33, 26); border: 1px solid rgb(52, 45, 36); border-radius: 16px; padding: 18px 16px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 11px; color: rgb(229, 169, 143)">
                    {!! $item2['icon'] ?? '' !!}
                    <span class="bn" style="font-size: 12.5px; color: rgb(163, 154, 136)">{{ $item['title'] ?? '' }}</span>
                </div>
                <div class="bh" style="font-weight: 800; font-size: 23px; color: rgb(255, 255, 255); letter-spacing: -0.5px; margin-bottom: 3px;">
                    {{ $item2['title'] ?? '' }}
                </div>
                <div class="bn" style="font-size: 12px; color: rgb(138, 130, 120); line-height: 1.45">
                    {{ $item2['subtitle'] ?? '' }}
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
<section style="max-width: 820px; margin: 0px auto; padding: 20px 20px">
   
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
                            <path d="M20 6L9 17l-5-5"></path></svg>সারাদেশে হোম ডেলিভারি
                        </span
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
                            <path d="M20 6L9 17l-5-5"></path></svg>ফ্রি ডিজিটাল বোনাস প্যাক
                    </span
                    >
                    <span style="display: flex; align-items: baseline; gap: 7px; white-space: nowrap"
                        ><span
                            class="num"
                            style="font-size: 13.5px; color: rgb(154, 145, 131); text-decoration: line-through"
                            >৳500</span
                        ><span class="bn" style="font-weight: 700; font-size: 13.5px; color: rgb(178, 58, 24)"
                            >ফ্রি</span
                        >
                    </span>
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
                        <path d="m9 12 2 2 4-4"></path></svg>
                    </span>
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
                onclick="buynow('{{ $productdetails->id }}')"
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
                    <path d="m9 12 2 2 4-4"></path></svg>এক টাকাও অগ্রিম নেই — হাতে পেয়ে, দেখে, তারপর পেমেন্ট।
            </div>
        </div>
    </div>
</section>
