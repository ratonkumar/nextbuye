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
    <meta itemprop="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">

    <meta property="og:url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $productdetails->ProductName }}">
    <meta property="og:description" content="{{ env('APP_NAME') }}-{{ $productdetails->ProductName }}">
    <meta property="og:image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
    <meta property="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}" />
    <meta property="url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
    <meta itemprop="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
    <meta property="twitter:card" content="https://arishatex.com/{{ $productdetails->ProductImage }}" />
    <meta property="twitter:title" content="{{ $productdetails->ProductName }}" />
    <meta property="twitter:url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
    <meta name="twitter:image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
@endsection
<style>
        
        table {
          width: 100%;
          table-layout: auto; /* Allows columns to adjust based on content */
          border-collapse: collapse; /* Optional: makes borders collapse for a cleaner look */
        }
        th, td {
            border: 1px solid #ddd; /* Adds border to table cells */
            padding: 8px;
            text-align: left;
        }
        td, th {
            white-space: nowrap; /* Prevents breaking text */
            width: auto !important; /* Allows dynamic resizing */
        }
        th {
            background-color: #f4f4f4;
        }
        @media screen and (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap; /* Prevents text from wrapping */
            }
        }
    h1, h2, h3, h4, h5, h6 {
        color: #222;
        font-family: "Lato", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        font-style: normal;
        font-weight: 400;
        line-height: 1.4;
        margin-bottom: 2rem;
        margin-top: 0px;
     
    }
aside.card{
    border: 0px;
}

.owl-item {
    border: 1px solid #D82A5D;
    /* margin: 6px; */
}
@media (min-width: 550px) and (max-width: 3000px) {
     .sizetext {
        color: 000;
        background: #fff;
    }
    .colortext {
        color: #000;
        background: #fff;
    }
    
    header.header-style-1 {
        display: none;
    }
     iframe {
        /*width: 100% !important;*/
        /*max-width: 100% !important;*/
    }
    span {
        /*font-size: 16px;*/
        text-align: left;
    }
    h2 {
        /*font-size: 18px;*/
        /*text-align: justify;*/
    }
    h1 {
        /*font-size: 17px !important;*/
        /*text-align: left;*/
    }
    .container .container-px {
        width: 80%;
        margin: 0px auto;
    }
    
}
@media screen and (max-width: 640px) {
    .container {
        width: 100% !important;
    }
    #logosm {
        float: none;
       
        margin: 0 auto;
    }
    p img {
        width: 100% !important;
        height: 100% !important;
    }
    .sizetext {
        color: 000;
        background: #fff;
    }
    .colortext {
        color: #000;
        background: #fff;
    }
    
    header.header-style-1 {
        display: none;
    }
     iframe {
        width: 100% !important;
        max-width: 80% !important;
    }
    span {
        font-size: 16px !important;
        text-align: left;
    }
    h2 {
        font-size: 15px;
        text-align: justify;
    }
    h1 {
        font-size: 27px !important;
        text-align: left;
    }
    .container .container-px {
        width: 98%;
        margin: 0px auto;
    }
    .row {
        width: 100% !important;
    }
        td, th {
        white-space: normal;
        width: auto !important;
    }
    .single_product_container .container {
  
        padding: 10px 0px !important;
    }
    table.table.table_top_cart.border-bottom {
        background: #EFFCFF;
        padding: 14px 0px;
        display: block;
    }
   .col-md-12.top_cart {
        padding-right: 4px;
        margin-right: 0px;
        padding-left: 2px;
    }
    a#formText {
        font-size: 26px !important;
    }
    span.total_amount {
        width: 86px;
        display: block;
        text-align: center;
        vertical-align: middle;
        padding-top: 59%;
    }
    .row {
        margin: 0px !important;
        max-width: none;
        width: auto;
    }
        a.mb-0.ml-2.btn.btn-styled.btn-base-1.btn-icon-left.strong-700.hov-bounce.hov-shaddow.buy-now.order_now {
        text-align: center;
        display: block;
        width: 95%;
        margin: 5px auto;
        height: 70px;
        padding-top: 13px;
        font-size: 23px;
        margin-bottom: 20px !important;
    }
    .qtyinfo {
        vertical-align: middle;
        display: block;
        margin-top: 37%;
        height: 50px;
    }
    .qty-container {
    
        gap: 0px;
    }
    .qty-input {
        width: 37px !important;
        text-align: center;
        height: 35px !important;
    }
        .qty-btn {
        /* width: 27px !important; */
        height: 36px !important;
        text-align: center;
        max-width: 20px !important;
        background: #eee;
        color: #666;
        border: none;
        border-radius: 2px;
        font-size: 20px;
        margin-top: 4px;
        padding-left: 11px;
        padding-right: 24px;
    }
    strong.elementor-button-text.order_now {
        font-size: 30px;
        height: 30px !important;
    }
}


</style>
<!-- Body -->
@if($productdetails->is_single_page)
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        loop: true,         // Infinite loop
        margin: 10,         // Space between items
        nav: true,          // Show next/prev buttons
        dots: true,         // Show pagination dots
        autoplay: true,     // Auto-slide
        autoplayTimeout: 3000, // Slide delay in ms
        responsive:{
            0:{ items: 1 },  // 1 item on small screens
            600:{ items: 2 }, // 2 items on tablets
            1000:{ items: 3 } // 3 items on larger screens
        }
    });
});
</script>
<div class="body-content" id="top-banner-and-menu">
    <div class="header_top">
        <div class="logo">
            <button type="button" onclick="openNav()" id="menubutton" class="d-lg-none">
                <img src="{{asset('public/menuooo.png')}}" style="width:40px">
            </button>

            <a href="{{ url('/') }}" id="logoimage"  class="single_image" >
                <img src="{{ asset(App\Models\Basicinfo::first()->logo) }}" alt="" class="product-logo" id="logosm" style="">
            </a>
        </div>
    </div>
    
    
        <div class='row single-product'>
            <div class='col-md-12 p-0'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">
                        <div class="container" style="width:80%">
                             <h1 class="name header_top_product" style="margin-top:16px !important;font-size:32px">{!! $productdetails->subTitleHEader !!} </h1>
                            <div class="owl-carousel">
                                @php
                                    $postImage = json_decode($productdetails->PostImage);
                                @endphp
                                @if(!empty($postImage))
                                    @forelse ($postImage as $productImage)
                                        <div><img src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" alt="Image 1"></div>
                                    @empty
                                    @endforelse
                                @endif
                             
                            </div>
                              <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#orderCheckout" style="margin-top:10px;background:{{\App\Models\Basicinfo::first()->single_order_button}}; border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                <span class="elementor-button-content-wrapper">
                                    <strong class="elementor-button-text order_now" style="background: {{ URL::asset(App\Models\Basicinfo::first()->single_order_button ) }}">অর্ডার করুন</strong>
                                </span>
                            </a>
                            <div class='row' style="width:100%">
                                <div class='col-md-12 p-0'>
                                
                                
                                    <div class="product_info"> {!! $productdetails->ProductDetails !!} </div>
                                 
                                    <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#orderCheckout" style="background:{{\App\Models\Basicinfo::first()->single_order_button}} ; border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                        <span class="elementor-button-content-wrapper">
                                             <strong class="elementor-button-text order_now">অর্ডার করুন</strong>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class='row' style="width:100%">
                                <h1 class="name header_top_product" style="margin-top:16px !important;">{!! $productdetails->subTitle1 !!}</h1>
                                 
                                <div class="product_info"> {!! $productdetails->ProductDetails1 !!} </div>
                                 
                                <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#orderCheckout" style="background:{{\App\Models\Basicinfo::first()->single_order_button}}; border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                    <span class="elementor-button-content-wrapper">
                                         <strong class="elementor-button-text order_now">অর্ডার করুন</strong>
                                    </span>
                                </a>
                            </div>
                            <div class='row' style="width:100%">
                                <div class='col-md-12 p-0'>
                                     <h1 class="name header_top_product" style="margin-top:16px !important;padding-bottom: 6px; line-height: 50px;">{!! $productdetails->subTitle2 !!}</h1>
                                     
                                     <div class="product_info"> {!! $productdetails->ProductDetails2 !!} </div>
                                     
                                    <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#orderCheckout" style="background:{{\App\Models\Basicinfo::first()->single_order_button}}; border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                        <span class="elementor-button-content-wrapper">
                                             <strong class="elementor-button-text order_now">অর্ডার করুন</strong>
                                        </span>
                                    </a>
                                    
                                </div>
                            </div>
                            
                            <div class="container">
                                <div class='col-md-12 p-0 container-px'>
                                     <h1 class="name header_top_product" style="margin-top:16px !important;padding-bottom: 6px;line-height: 30px;">{!! $productdetails->subTitle3 !!}</h2>
                                     
                                     <div class="product_info"> {!! $productdetails->ProductDetails3 !!} </div>
                                     
                                    <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#orderCheckout" style="background:{{\App\Models\Basicinfo::first()->single_order_button}}; border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                        <span class="elementor-button-content-wrapper">
                                             <strong class="elementor-button-text order_now">অর্ডার করুন</strong>
                                        </span>
                                    </a>
                                    
                                </div>
                            </div>
                        <!--<div class="col-xs-12 col-sm-12  gallery-holder">-->
                        <!--    <div class="product-item-holder size-big single-product-gallery small-gallery header_gallery">-->
                        <!--        <h1 class="name header_top_product" style="margin-top:16px !important;padding-bottom: 6px;border-bottom: 1px solid #dfd6d6; line-height: 50px;">-->
                        <!--            {{ $productdetails->ProductName }}</h1>-->
                        <!--        @if (isset($productdetails->PostImage))-->
                        <!--            <div id="sync1" class="owl-carousel owl-theme">-->
                        <!--                <div class="items">-->
                        <!--                    <img class="w-100 h-100" src="{{ asset($productdetails->ProductImage) }}" alt="" style="border-radius: 4px;">-->
                        <!--                </div>-->
                        <!--                @forelse (json_decode($productdetails->PostImage) as $productImage)-->
                        <!--                    <div class="items">-->
                        <!--                        <img class="w-100 h-100"-->
                        <!--                            src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" alt="" style="border-radius: 4px;">-->
                        <!--                    </div>-->
                        <!--                @empty-->
                        <!--                @endforelse-->
                        <!--            </div>-->
                        <!--            <div id="sync2" class="owl-carousel owl-theme" style="padding-top: 10px;">-->
                        <!--                @forelse (json_decode($productdetails->PostImage) as $productImage)-->
                        <!--                    <div class="items">-->
                        <!--                        <img class="w-100 h-100" style="padding:10px;border:1px solid;border-radius: 4px;"-->
                        <!--                            src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" alt="">-->
                        <!--                    </div>-->
                        <!--                @empty-->
                        <!--                @endforelse-->
                        <!--            </div>-->
                        <!--        @else-->
                        <!--            <div class="items">-->
                        <!--                <img class="w-100 h-100" src="{{ asset($productdetails->ProductImage) }}" alt="" style="border-radius: 4px;">-->
                        <!--            </div>-->
                        <!--        @endif-->
        
                        <!--    </div>-->
                            <!-- /.single-product-gallery -->
                        <!--    <a class=" mb-0  ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now order_now" href="#order">-->
                        <!--        <span class="elementor-button-content-wrapper">-->
                        <!--            <span class="elementor-button-text">অর্ডার করুন</span>-->
                        <!--        </span>-->
                        <!--    </a>-->
                        <!--</div>-->
                   
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.col -->
            <div class="clearfix"></div>
        </div>
    </div>   
    <!-- /.container -->
</div>
<!-- /.body-content -->
<section class="section-content padding-y bg slidetop single_product_container" id="orderCheckout">
            <div class="container p-0">
                <div class="row"> 
                    <h2 style="width: 100%;font-size: 32px; text-align:center "><a  id="formText" href="tel:{{App\Models\Basicinfo::first()->phone_one}}" style="font-size: 32px; text-align:center "> কল করুন {{App\Models\Basicinfo::first()->phone_one}}</a>
</h2>
                    <div class="col-md-12 top_cart">
                        <table class="table table_top_cart border-bottom table-responsive" >
                            <thead>
                                <tr>
                                    <td >Product</td>
                                    <td >Quantity</td>
                                    <td >Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topproducts as $cartProduct)
                                    <tr class="cart-item" id="productcart{{ $cartProduct->id }}">
                                        <td class="product-image" id="proImgDiv">
                                            <div class="wcf-item-selector wcf-item-single-sel">
                                                <input class="wcf-single-sel"  type="radio" id="check_value_{{ $cartProduct->id }}" name="wcf-single-sel" value="{{ $cartProduct->id }}"  @if( $productdetails->id == $cartProduct->id )checked="" @endif onclick="productCartChange('{{ $cartProduct->id }}')">
                                                <label class="wcf-item-product-label" for="wcf-item-product-{{ $cartProduct->id }}"></label>
                                            </div>
                                            <div class="product_left product_img">
                                                <a href="#" class="mr-3 product_iamge_left">
                                                    <img class=" ls-is-cached lazyloaded"
                                                         src="{{ asset($cartProduct->ProductImage) }}" id="proImg" style="width:50px;height:auto;">
                                                </a>
                                            </div>
                                            <div class="product_left">
                                                <span class="pr-4 d-block w-100 product_content_right"  id="proName">{{ $cartProduct->ProductName }}</span>
                                            </div>
                                        </td>
    
    
                                        <td class="product-name">
                                            
                                            <div class="ext w-100">
                                             
                                                <div class="qtyinfo">
                                                    <div class="qty-container">
                                                        <button class="qty-btn minus"  onclick="productCartChange('{{ $cartProduct->id }}')">-</button>
                                                        <input type="number" class="qty-input" value="1" min="1" id="product_qty_{{ $cartProduct->id }}" onclick="productCartChange('{{ $cartProduct->id }}')">
                                                        <button class="qty-btn plus" data-id="" onclick="productCartChange('{{ $cartProduct->id }}')">+</button>
                                                    </div>
                                              
                                                </div>
                                            </div>
                                            
                                            <input type="text" name="productP" id="priceOf{{ $cartProduct->id }}" value="{{ $cartProduct->ProductSalePrice }}" hidden>
                                            <input type="text" name="size" value="" hidden>
                                            <input type="text" name="color" value="" hidden>
                                        </td>
                                       <td class="product-total" style="width: 180px;" >
                                            <span class="total_amount">৳ <span id="pricetotal{{ $cartProduct->id }}"
                                                          class="price">{{$cartProduct->ProductSalePrice }}</span></span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-6">
                        <aside class="card mb-4">
                            <article class="card-body ">
                                <header class="mb-4" >
                                
                                        <h1 class="m-0" style="font-size: 22px;">
                                           অর্ডারের তথ্য..</h1>

                                </header>
                                <form action="{{ url('press/order') }}" method="POST"
                                      class="from-prevent-multiple-submits" id="orderForm">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>আপনার নাম *</label>
                                            <input type="text" id="customerName" name="customerName"
                                                   @if(Auth::id()) value="{{Auth::guard('web')->user()->name}}"
                                                   @else @endif    placeholder="আপনার নাম লিখুন"
                                                   required class="form-control"
                                                   style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                        </div>
                                        @if(Auth::id())
                                            <input type="text" id="user_id" name="user_id"
                                                   @if(Auth::id()) value="{{Auth::guard('web')->user()->id}}"
                                                   @else @endif hidden>
                                        @else

                                        @endif
                                        <div class="form-group col-sm-12">
                                            <label>আপনার ঠিকানা * </label>
                                            <input type="text" id="customerAddress" name="customerAddress"
                                                   placeholder="আপনার ঠিকানা লিখুন" required class="form-control"
                                                   style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>আপনার মোবাইল * </label>
                                            <input type="text" minlength="11" maxlength="11"
                                                   pattern="[0-1]{2}[0-9]{6}[0-9]{3}" id="customerPhone"
                                                   @if(Auth::id()) value="{{Auth::guard('web')->user()->phone}}"
                                                   @else @endif  name="customerPhone" required
                                                   class="form-control" placeholder="আপনার মোবাইল লিখুন">
                                        </div>
                                        <textarea id="ordersubtotalprice" name="subTotal" cols="10" rows="5"
                                                  hidden>{{ Cart::subtotalFloat() }}</textarea>
                                        <div class="form-group col-sm-12">
                                            <label>Shipping</label>
                                            <select id="deliveryCharge" name="deliveryCharge" class="form-control"
                                                    onchange="setdeliverychargr()">
                                                @if (isset($product->inside_dhaka) && isset($product->outside_dhaka))
                                                    <option value="{{ $product->inside_dhaka }}">ঢাকার ভিতর
                                                        ({{ $product->inside_dhaka }})
                                                    </option>
                                                    <option value="{{ $product->outside_dhaka }}">ঢাকার বাহির
                                                        ({{ $product->outside_dhaka }})
                                                    </option>
                                                @else
                                                    <option value="{{App\Models\Basicinfo::first()->inside_dhaka_charge}}">
                                                        ঢাকার ভিতর
                                                        ({{App\Models\Basicinfo::first()->inside_dhaka_charge}})
                                                    </option>
                                                    <option value="{{App\Models\Basicinfo::first()->outside_dhaka_charge}}">
                                                        ঢাকার বাহির
                                                        ({{App\Models\Basicinfo::first()->outside_dhaka_charge}})
                                                    </option>
                                                @endif

                                            </select>


                                        </div>

                                        <div class="section-tab check-mark-tab text-center pb-4" id="paysection">
                                            <ul class="nav nav-tabs justify-content-around m-0" id="myTab"
                                                role="tablist">
                                            
                                                <li class="nav-item active" role="presentation">
                                                    <a class="nav-link active"
                                                       id="credit-card-tab" style="padding: 8px;" data-bs-toggle="tab"
                                                       href="#credit-card" role="tab" aria-controls="credit-card"
                                                       aria-selected="true" tabindex="-1" onclick="showCashOnDelivery()">
                                                        <img src="https://khati.plus/public/cod.png"
                                                             style="width: 65px;" alt="">
                                                        <span class="d-block pt-2">Cash on Delivery</span>
                                                    </a>
                                                </li>
                                                <!--<li class="nav-item" role="presentation">-->
                                                <!--    <a class="nav-link"  id="paypal-tab"-->
                                                <!--       data-bs-toggle="tab" href="#paypal" role="tab"-->
                                                <!--       aria-controls="paypal" style="    padding: 8px;"-->
                                                <!--       aria-selected="false" tabindex="-1" onclick="showOnlinePay()">-->
                                                <!--        <img src="https://khati.plus/public/sslcommerz.png"-->
                                                <!--             style="width: 65px;" alt="">-->
                                                <!--        <span class="d-block pt-2">Online Pay</span>-->
                                                <!--    </a>-->
                                                   
                                                <!--</li>-->
                                            </ul>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" id="orderConfirm"
                                                    class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                                    style="background:green;color:white;font-size:30px; width: 100% !important;border:1px solid {{\App\Models\Basicinfo::first()->single_order_button}}">
                                                <i class="spinner fa fa-spinner fa-spin"></i> অর্ডার কনফার্ম করুন
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                    <!--<button id="sslczPayBtn"  class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"-->
                                    <!--        token="if you have any token validation" style="display: none; background:green;color:white;font-size:30px; width: 100% ;height: 60px !important;"-->
                                    <!--        postdata=""-->
                                    <!--        order="If you already have the transaction generated for current order"-->
                                    <!--        endpoint="{{url('/pay-via-ajax')}}"> Pay Now-->
                                    <!--</button>-->
                                        </div>
                                    </div>
                                </form>
                            </article> <!-- card-body.// -->
                        </aside>
                    </div>
                    <div class="col-md-6 orderDetails" id="resultOfCart">
                        <aside class="card">

                            <header class="mb-4">
                                <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
                            </header>
                            <div class="row">
                                <div class="col-md-12" >                
                                        <table class="table border-bottom">
                                            @forelse ($cartProducts as $cartProduct)
                                                <tr class="cart-item" id="productcart{{ $cartProduct->rowId }}">
                                                    <td class="product-image" id="proImgDiv">
                                                        <a href="#" class="mr-3">
                                                            <img class=" ls-is-cached lazyloaded"
                                                                 src="{{ asset($cartProduct->image) }}" id="proImg" style="width:50px;height:auto;">
                                                        </a>
                                                    </td>
                                        
                                                    <td class="product-total" style="width: 80px;" hidden>
                                                        <span>৳ <span id="pricetotal{{ $cartProduct->rowId }}"
                                                                      class="price">{{ $cartProduct->qty * $cartProduct->price }}</span></span>
                                                    </td>
                                        
                                                    <td class="product-name">
                                                        <span class="pr-4 d-block w-100"
                                                              id="proName">{{ $cartProduct->name }}</span>
                                                        <div class="ext w-100">
                                                            <div class="price">
                                                                <span class="pr-3 d-block" id="proPrice">৳
                                                                    {{ $cartProduct->price }} * {{ $cartProduct->qty }} </span>
                                                            </div>
                                                            <div class="qtyinfo" style="display:none">
                                                                <div class="input-group input-group--style-2 pr-4"
                                                                     style="width: 130px;float:left">
                                                                    <span class="input-group-btn" style="display:none">
                                                                        <button class="btn btn-number"
                                                                                onclick="remnum('{{$cartProduct->rowId}}')"
                                                                                id="remqty" type="button">
                                                                            <i class="fas fa-minus"></i>
                                                                        </button>
                                                                    </span>
                                                                    <input type="text"
                                                                           name="quantity[{{ $cartProduct->id }}]"
                                                                           id="QuantityPeo{{ $cartProduct->rowId }}"
                                                                           class="form-control input-number" placeholder="1"
                                                                           value="{{ $cartProduct->qty }}" min="1" max="10"
                                                                           onchange="updateQuantity('{{ $cartProduct->rowId }}', this)" readonly>
                                                                    <span class="input-group-btn" style="display:none">
                                                                        <button class="btn btn-number"
                                                                                onclick="updatenum('{{$cartProduct->rowId}}')"
                                                                                id="äddqty" type="button">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                           
                                                            </div>
                                                        </div>
                                                    </td>
                                                        <input type="text" name="productP" id="priceOf{{ $cartProduct->rowId }}" value="{{ $cartProduct->price }}" hidden>
                                                        <input type="text" name="size" value="{{ $cartProduct->options->size }}" hidden>
                                                        <input type="text" name="color" value="{{ $cartProduct->options->color }}" hidden>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </table>
                                    </div>
                                </div>
                                <!--</article>-->
                        
                            <article class="card-body border-top">
                                <dl class="row">
                                    <dt class="col-sm-8">Subtotal:</dt>
                                    <dd class="col-sm-4 text-right"><strong>৳ <span
                                                    id="subtotalprice">{{ Cart::subtotalFloat() }}</span> </strong></dd>
                        
                                    <dt class="col-sm-8">Delivery charge:</dt>
                                    <dd class="col-sm-4 text-danger text-right"><strong>৳
                                            @php $charge = 0 ; @endphp
                                            @if (isset($product->inside_dhaka))
                                                @php $charge = $product->inside_dhaka ; @endphp
                                                <span id="dinamicdalivery">{{ $product->inside_dhaka }}</span>
                                            @else
                                                @php $charge = App\Models\Basicinfo::first()->inside_dhaka_charge; @endphp
                                                <span id="dinamicdalivery">{{App\Models\Basicinfo::first()->inside_dhaka_charge}}</span>
                                            @endif
                                        </strong></dd>
                                    <hr>
                                    <dt class="col-sm-8">Total:</dt>
                                    <dd class="col-sm-4 text-right"><strong class="h5 text-dark">৳ <span
                                                    id="totalamount">{{Cart::subtotalFloat() + $charge }} </span></strong></dd>
                                </dl>
                        
                            </article>
                        </aside>
                    </div>

                </div>
            </div>
        </section>

{{-- modal for process and cart --}}

{{ csrf_field() }}

<script>
        $(document).ready(function() {
            $(".plus").click(function() {
                let input = $(this).siblings(".qty-input");
                let value = parseInt(input.val());
                input.val(value + 1);
            });

            $(".minus").click(function() {
                let input = $(this).siblings(".qty-input");
                let value = parseInt(input.val());
                if (value > 1) {
                    input.val(value - 1);
                }
            });
        });
    </script>

<script>

    // $('#processing').css({
    //             'display': 'flex',
    //             'justify-content': 'center',
    //             'align-items': 'center'
    //         })
    //         $('#processing').modal('show');
//     $.ajax({
//         type: 'get',
//         url: '{{ url('add-to-cart') }}',
//         processData: false,
//         contentType: false,
//       	data: {
// 			'_token': $('input[name=_token]').val(),
// 			'product_id': '{{ $productdetails->id }}'
// 		},

//         success: function(data) {
//             updatecart();
//             if (data == 'success') {
//                 window.location.href = 'https://arishatex.com/checkout';
//                 $('#processing').modal('hide');
//             }
//         },
//         error: function(error) {
//             console.log('error');
//         }
//     });
            
    function productCartChange(productID) {
        setTimeout(() => {
        var qty = $('#product_qty_'+ productID).val();
          
           
           if($('#check_value_'+productID).is(':checked') == true) {
                $('#processing').css({
                    'display': 'flex',
                    'justify-content': 'center',
                    'align-items': 'center'
                })
                $('#processing').modal('show');
                
          
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
           
                 $.ajax({
                    type: 'GET',
                    url: '{{ url('single-add-to-cart?type=1') }}&productID='+ productID + '&qty=' + qty,
                    // url: '{{ url('single-add-to-cart') }}?type=1&productID='+ productID + '&qty=' + qty,
                    processData: false,
                    contentType: false,
                        //  data: {
                        //     // '_token': $('input[name=_token]').val(),
                        //     'productID': productID
                        // },
                                // data: new FormData(this),
    
                    success: function(data) {
                        // updatecart();
                        // $.ajax({
                        //     type: 'GET',
                        //     url: '{{ url('get-cart-content') }}',
    
                        //     success: function(response) {
                        //         $('#cartViewModal .modal-body').empty().append(
                        //             response);
                        //     },
                        //     error: function(error) {
                        //         console.log('error');
                        //     }
                        // });
                        $('#processing').modal('hide');
                        $('#resultOfCart').html(data);
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
                
                $.ajax({
                    type: 'GET',
                    url: '{{ url('single-add-to-cart?type=2') }}&productID='+ productID + '&qty=' + qty,
                    // processData: false,
                    // contentType: false,
                        //  data: {
                        //     // '_token': $('input[name=_token]').val(),
                        //     'productID': productID
                        // },
                                // data: new FormData(this),
    
                    success: function(data) {
                      
                        $('#ordersubtotalprice').val(data);
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
           }
        }, 500);
   };
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
                        window.location.href = 'https://arishatex.com/checkout';
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
    function setdeliverychargr() {
        var deliverycharge = $('#deliveryCharge').val();
        $('#dinamicdalivery').html(deliverycharge);

        var subprice = $('#subtotalprice').html();
        var totalprice = subprice - (-deliverycharge);
        $('#totalamount').html(totalprice)
    }

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
        var qty = $(this).val();
        
        $('#qtyor').val(qty);
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
@endif
@endsection
