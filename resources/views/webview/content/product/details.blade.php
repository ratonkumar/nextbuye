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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- এই ৫টি লাইন WhatsApp প্রিভিউ নিয়ে আসবে -->
    
@endsection
<style>

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
<div class="container my-4">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center p-3 border rounded">
                <i class="fa fa-truck mr-3" style="font-size: 24px;"></i>
                <div>
                    <strong>ফ্রি ডেলিভারি</strong><br><small>সারাদেশে</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center p-3 border rounded">
                <i class="fa fa-wallet mr-3" style="font-size: 24px;"></i>
                <div>
                    <strong>ক্যাশ অন ডেলিভারি</strong><br><small>হাতে পেয়ে পেমেন্ট</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center p-3 border rounded">
                <i class="fa fa-shield-alt mr-3" style="font-size: 24px;"></i>
                <div>
                    <strong>৬ মাস ওয়ারেন্টি</strong><br><small>রিপ্লেসমেন্ট</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="d-flex align-items-center p-3 border rounded">
                <i class="fa fa-check-circle mr-3" style="font-size: 24px;"></i>
                <div>
                    <strong>১০০% অরিজিনাল</strong><br><small>কোয়ালিটি গ্যারান্টি</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- নিচের গাঢ় রঙের ফিচার সেকশন -->
<div class="container-fluid" style="background: #1a1a1a; padding: 40px 0; color: #fff;">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-3">
                <h2 style="color: #ff5722;">১০ সে.</h2>
                <p>এক চাপে কুচি রেডি</p>
            </div>
            <div class="col-md-3 mb-3">
                <h2 style="color: #ff5722;">১৭০০</h2>
                <p>RPM মোটর স্পিড</p>
            </div>
            <div class="col-md-3 mb-3">
                <h2 style="color: #ff5722;">২৫০ml</h2>
                <p>বাটি ক্যাপাসিটি</p>
            </div>
            <div class="col-md-3 mb-3">
                <h2 style="color: #ff5722;">৬ মাস</h2>
                <p>রিপ্লেসমেন্ট ওয়ারেন্টি</p>
            </div>
        </div>
    </div>
</div>
<div class="body-content mt-4" id="top-banner-and-menu">
    <div class='container'>
  
        <div class="row single-product">
            <div class="col-md-12 p-0">
                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell" style="display: inline-flex;">
                                <li class="active"><a data-bs-toggle="tab" id="istteb"
                                        href="#description">DESCRIPTION</a></li>
                                <li><a data-bs-toggle="tab" href="#review" onclick="removeDesc()">REVIEW</a></li>
                                <li ><a data-bs-toggle="tab" href="#shipping-info" onclick="removeDesc()">SHIPPING INFO</a>
                                </li>
                            </ul>
                            <!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-12">

                            <div class="tab-content">

                                <div id="description" class="tab-pane">
                                    <div class="product-tab">
                                        <p class="text">{!! $productdetails->ProductDetails !!}</p>
                                        @if (isset($productdetails->youtube_embade))
                                            <br>
                                            <div class="card">
                                                <div class="card-body">
                                                    <iframe width="100%" height="315"
                                                        src="https://www.youtube.com/embed/{{ $productdetails->youtube_embade }}">
                                                    </iframe>
                                                </div>
                                            </div>
                                        @else

                                        @endif
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">

                                            <div class="row">
                                                <div class="review">

                                                </div>

                                            </div>
                                            <!-- /.reviews -->
                                        </div>

                                    </div>
                                    <!-- /.product-tab -->
                                </div>
                                <!-- /.tab-pane -->

                                <div id="shipping-info" class="tab-pane">
                                    <div class="product-tag">

                                        <div class="row">
                                            <div class='p-0 col-sm-12 col-md-3 product-info-block '
                                                style="padding: 0;">
                                                <div class="row no-gutters mt-2 ">
                                                    <div class="col-1 col-sm-1">
                                                        <i class="fas fa-phone" aria-hidden="true"
                                                            style="font-size: 18px;color: #8a8686;"></i>
                                                    </div>
                                                    <div class="col-5 col-sm-5">
                                                        <div class="product-description-label" id="textsize">
                                                            Contact Us:</div>
                                                    </div>
                                                    <div class="col-5 col-sm-5" id="textsize">
                                                        <a href="tel:" target="_blank" id="textsize">
                                                            {{ $shipping->contact }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters mt-2">
                                                    <div class="col-1 col-sm-1">
                                                        <i class="fas fa-motorcycle" aria-hidden="true"
                                                            style="font-size: 16px;col-smor: #8a8686;"></i>
                                                    </div>
                                                    <div class="col-5 col-sm-5 pe-0">
                                                        <div class="product-description-label" id="textsize">

                                                            Inside Dhaka:</div>
                                                    </div>
                                                    <div class="col-5 col-sm-5" id="textsize">
                                                        {{ $shipping->insie_dhaka }}
                                                    </div>
                                                </div>
                                                <div class="row no-gutters mt-2">
                                                    <div class="col-1 col-sm-1">
                                                        <i class="fas fa-truck" aria-hidden="true"
                                                            style="font-size: 18px;col-smor: #8a8686;"></i>
                                                    </div>
                                                    <div class="col-5 col-sm-5">
                                                        <div class="product-description-label" id="textsize">

                                                            Outside Dhaka:</div>
                                                    </div>
                                                    <div class="col-5 col-sm-5" id="textsize">
                                                        {{ $shipping->outside_dhaka }}

                                                    </div>
                                                </div>
                                                <div class="row no-gutters mt-2">
                                                    <div class="col-1 col-sm-1">
                                                        <i class="fas fa-money-bill-alt" aria-hidden="true"
                                                            style="font-size: 18px;col-smor: #8a8686;"></i>
                                                    </div>

                                                    <div class="col-5 col-sm-5">
                                                        <div class="product-description-label" id="textsize"> Cash on
                                                            Delivery :</div>
                                                    </div>
                                                    <div class="col-5 col-sm-5" id="textsize">
                                                        @if ($shipping->cash_on_delivery == 'ON')
                                                            Available
                                                        @else
                                                            Unavailable
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="row no-gutters mt-2">
                                                    <div class="col-1 col-sm-1">
                                                        <i class="fas fa-refresh" aria-hidden="true"
                                                            style="font-size: 18px;col-smor: #8a8686;"></i>
                                                    </div>
                                                    <div class="col-5 col-sm-5">
                                                        <div class="product-description-label" id="textsize">Refund
                                                            Rules:</div>
                                                    </div>
                                                    <div class="col-5 col-sm-5" id="textsize">
                                                        {{ $shipping->refund_rule }}<a
                                                            href="#" class="ml-2"
                                                            target="_blank">View Policy</a>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters mt-2">
                                                    <div class="col-2 col-sm-2" id="textsize">
                                                        <div class="product-description-label pt-2"
                                                            style="padding-top: 14px;">Payment:</div>
                                                    </div>
                                                    <div class="col-10 col-sm-10">
                                                        <ul class="inline-links">
                                                            <li>
                                                                <img src="{{ asset('public/webview/assets/images/Payment-Methods.gif') }}"
                                                                    width="98%" class=" ">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.product-tab -->
                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="pb-2 section featured-product wow fadeInUp" style="margin-bottom:0px !important">
                    <h3 class="section-title" style="border-bottom: 1px solid #e62e04;    padding: 8px;margin-bottom: 0;">Related
                        products</h3>
                    <div class="owl-carousel related-owl-carousel featured-carousel owl-theme outer-top-xs"
                        id="relatedCarousel">
                        @forelse ($relatedproducts as $relatedproduct)
                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product" id="featuredproduct">
                                        <div class="row product-micro-row">
                                        <div class="col-12">
                                            <div class="product-image">
                                                <div class="image text-center">
                                                    <a href="{{ url('product/' . $relatedproduct->ProductSlug) }}">
                                                        <img src="{{ asset($relatedproduct->ViewProductImage) }}"
                                                            alt="{{ $relatedproduct->ProductName }}" id="featureimage">
                                                    </a>
                                                </div>
                                                <!-- /.image -->
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <div class="infofe p-md-3 p-2" style="padding-bottom: 4px !important;">
                                                <div class="product-info">
                                                    <h2 class="name text-truncate" id="f_name"><a
                                                            href="{{ url('product/' . $relatedproduct->ProductSlug) }}"
                                                            id="f_pro_name">{{ $relatedproduct->ProductName }}s</a></h2>
                                                </div>
                                                <div class="price-box">
                                                    <!--<del class="old-product-price strong-400">৳{{ round($relatedproduct->ProductRegularPrice) }}</del>-->
                                                    <span
                                                        class="product-price strong-600">৳{{ round($relatedproduct->ProductSalePrice) }}</span>
                                                </div>
                                            </div>
                                             @if (!empty($relatedproduct->weight) && $relatedproduct->is_weight == 1)
                                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                    style="width: 100%;float: left;text-align: center;">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="text" name="color" id="product_colorold" hidden>
                                                    <input type="text" name="size" id="product_sizeold" hidden>
                                                    <input type="text" name="product_id" value=" {{ $relatedproduct->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    @if (!empty($relatedproduct->weight) && $relatedproduct->is_weight == 1)
                                                        @php  $weightInfo = json_decode($relatedproduct->weight); @endphp
                                                        @if(!empty($weightInfo[0]->weight))
                                                    <input type="text" name="weight" id="product_weight_cart" value="{{ $weightInfo[0]->weight ?? 0 }}" hidden>
                                                    <input type="text" name="sale_price" id="product_weight_salePrice"  value="{{ $weightInfo[0]->sale_price ?? 0 }}" hidden>
                                                    <input type="text" name="rg_price" id="product_weight_regularPrice"   value="{{ $weightInfo[0]->regular_price ?? 0 }}" hidden>
                                                     @endif
                                                            @endif
                                        
                                        
                                                    <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                            style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                                </form>
                                            @else 
                                            
                                            <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                style="width: 100%;float: left;text-align: center;">
                                                @method('POST')
                                                @csrf
                                                <input type="text" name="color" id="product_colorold" hidden>
                                                <input type="text" name="size" id="product_sizeold" hidden>
                                                <input type="text" name="product_id" value=" {{ $relatedproduct->id }}"
                                                    hidden>
                                                <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                        style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                            </form>
                                            @endif

                                        </div>
                                       
                                        <!-- /.col -->
                                    </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div>
        </div>
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /.body-content -->

<div class="container mt-4">

    <div class="row">
        <div class="col-sm-12 p-0">
            <section class="pb-2 section featured-product wow fadeInUp">
                <div class="col-12" style="border-bottom: 1px solid #e62e04;padding-left: 0;display: flex;justify-content: space-between;">
                    <div class="px-2 p-md-3 pt-0 d-flex justify-content-between" style="padding-bottom:4px !important;padding-top: 8px !important;">
                        <h4 class="m-0"><b>Promotional Offers</b></h4>
                    </div>
                    <a href="{{ url('promotional/products') }}" class="btn btn-danger btn-sm mb-0" style="padding: 2px;height: 26px;color: white;font-weight: bold;margin-top:9px;">VIEW ALL</a>
                </div>
                <div class="owl-carousel " id="promotionalofferSlide">
                    @forelse ($topproducts as $promotional)
                        <div class="item" id="featuredproduct">
                            <div class="products best-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col-12">
                                                <div class="product-image">
                                                    <div class="image text-center">
                                                        <a href="{{ url('product/' . $promotional->ProductSlug) }}">
                                                            <img src="{{ asset($promotional->ProductImage) }}"
                                                                alt="{{ $promotional->ProductName }}"
                                                                id="featureimage">
                                                        </a>
                                                    </div>
                                                    <!-- /.image -->
                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12">
                                                <div class="infofe p-md-3 p-2"
                                                    style="padding-bottom: 4px !important;">
                                                    <div class="product-info">
                                                        <h2 class="name text-truncate" id="f_name"><a
                                                                href="{{ url('product/' . $promotional->ProductSlug) }}"
                                                                id="f_pro_name">{{ $promotional->ProductName }}s</a>
                                                        </h2>
                                                    </div>
                                                    <div class="price-box">
                                                        <del
                                                            class="old-product-price strong-400">৳{{ round($promotional->ProductRegularPrice) }}</del>
                                                        <span
                                                            class="product-price strong-600">৳{{ round($promotional->ProductSalePrice) }}</span>
                                                    </div>
                                                </div>
                                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                    style="width: 100%;float: left;text-align: center;">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="text" name="color" id="product_colorold" hidden>
                                                    <input type="text" name="size" id="product_sizeold" hidden>
                                                    <input type="text" name="product_id" value=" {{ $promotional->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                            style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                                </form>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <!-- /.home-owl-carousel -->
            </section>
        </div>
    </div>

</div>
<!-- Body end -->


{{-- modal for process and cart --}}

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
