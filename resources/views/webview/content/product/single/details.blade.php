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

         @php
            // নিয়মিত মূল্য এবং বিক্রয় মূল্যের পার্থক্য বের করা
            $regularPrice = intval($productdetails->ProductRegularPrice);
            $salePrice = intval($productdetails->ProductSalePrice);
            $savings = $regularPrice - $salePrice;
        @endphp

        <div class="d-flex align-items-center mt-3">
            <span class="mr-3">নিয়মিত মূল্য <s>৳{{ $regularPrice }}</s></span>
            
            @if($savings > 0)
                <span class="discount-badge">৳{{ $savings }} সাশ্রয়</span>
            @endif
        </div>

        <div class="price-box">৳{{ $salePrice }}</div>

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