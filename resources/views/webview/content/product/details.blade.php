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
<div class="body-content mt-4" id="top-banner-and-menu">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-12 p-0'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-12 col-md-6 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                @if (isset($productdetails->PostImage))
                                    <div id="sync1" class="owl-carousel owl-theme">
                                        <div class="items">
                                             <a href="{{ asset($productdetails->ProductImage) }}" data-fancybox="gallery">
                                            <img class="w-100 h-100" src="{{ asset($productdetails->ProductImage) }}" alt="" style="border-radius: 4px;">
                                            </a>
                                        </div>
                                        @forelse (json_decode($productdetails->PostImage) as $productImage)
                                            <div class="items">
                                                 <a href="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" data-fancybox="gallery">
                                                <img class="w-100 h-100"
                                                    src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" alt="" style="border-radius: 4px;">
                                                </a>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div id="sync2" class="owl-carousel owl-theme" style="padding-top: 10px;">
                                        @forelse (json_decode($productdetails->PostImage) as $productImage)
                                            <div class="items"  href="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" data-fancybox="gallery">
                                                 <a href="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" data-fancybox="gallery">
                                                <img class="w-100 h-100" style="padding:10px;border:1px solid;border-radius: 4px;"
                                                    src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}" alt="">
                                                </a>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                @else
                                    <div class="items">
                                          <a href="{{ asset($productdetails->ProductImage) }}" data-fancybox="gallery">
                                        <img class="w-100 h-100" src="{{ asset($productdetails->ProductImage) }}" alt="" style="border-radius: 4px;">
                                        </a>
                                    </div>
                                @endif

                            </div>
                            <!-- /.single-product-gallery -->
                        </div>
                        <!-- /.gallery-holder -->
                        <div class="col-sm-12 col-md-6 product-info-block" id="paddingnone">
                            <div class="product-info">
                                <h1 class="name"
                                    style="margin-top:16px !important;padding-bottom: 6px;border-bottom: 1px solid #dfd6d6;font-size: 20px !important; line-height: 22px;">
                                    {{ $productdetails->ProductName }}</h1>


                                <!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10"
                                    style="margin-top:10px;border-bottom: 1px solid #dfd6d6;">
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-2 col-sm-2">
                                            <div class="product-description-label label bg-none" id="productPricetitle">PRICE:</div>
                                        </div>
                                        <div class="col-9 col-sm-9">
                                            @if ($productdetails->is_weight == 0)
                                                 <div class="product-price strong-700" id="productPriceAmount">
                                                    <del style="font-size: 20px;color: red;" id="regularPrice">৳{{intval($productdetails->ProductRegularPrice)}}</del> &nbsp;&nbsp;
                                                    <span id="salePrice">৳ {{ $productdetails->ProductSalePrice }}</span>
                                                </div>
                                            @endif
                                            @if ( $productdetails->is_weight == 1)
                                                @php  $weightInfo = json_decode($productdetails->weight); @endphp
                                                @if(!empty($weightInfo[0]->weight))
                                                <div class="product-price strong-700" id="productPriceAmount">
                                                    <del style="font-size: 20px;color: red;" id="regularPrice">৳{{intval($weightInfo[0]->regular_price)}}</del> &nbsp;&nbsp;
                                                    <span id="salePrice">৳ {{ $weightInfo[0]->sale_price }}</span>
                                                </div>
                                                @else 
                                                <div class="product-price strong-700" id="productPriceAmount">
                                                    <del style="font-size: 20px;color: red;" id="regularPrice">৳{{intval($productdetails->ProductRegularPrice)}}</del> &nbsp;&nbsp;
                                                    <span id="salePrice">৳ {{ $productdetails->ProductSalePrice }}</span>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.stock-container -->
                                <div class="quantity-container info-container"
                                    style="border-bottom: 1px solid #dfd6d6;">
                                    <div class="row">

                                        <div class="col-2 col-sm-2">
                                            <span class="label bg-none">Quantity :</span>
                                        </div>

                                        <div class="col-3 col-sm-3">
                                            <div class="cart-quantity">
                                                <div class="">
                                                    <div class="qtyinfo">
                                                    <div class="qty-container">
                                                        <button class="qty-btn minus"  onclick="productCartChange('{{ $productdetails->id }}')">-</button>
                                                        <input type="number" class="qty-input" value="1" min="1" id="qty_change" onclick="productCartChange('{{ $productdetails->id }}')">
                                                        <button class="qty-btn plus" data-id="" onclick="productCartChange('{{ $productdetails->id }}')">+</button>
                                                    </div>
                                              
                                                </div>
                                                    <!--<input type="number" value="1" id="qty_change">-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-sm-6">

                                        </div>


                                    </div>
                                    <!-- /.row -->
                                </div>
                                
                                  <!-- /.stock-container -->
                                <div class="quantity-container info-container"
                                    style="border-bottom: 1px solid #dfd6d6;">
                                    <div class="row">

                                        <div class="col-2 col-sm-2">
                                            <span class="label bg-none">CODE :</span>
                                        </div>

                                        <div class="col-8 col-sm-8">
                                           <p style="margin-bottom: 8px;margin-top: 7px;">
                                                 {!! $productdetails->ProductSku !!}
                                            </p>  
                                        </div>

                                        <div class="col-6 col-sm-6">

                                        </div>


                                    </div>
                                    <!-- /.row -->
                                </div>
                                <div class="row mb-2 mt-2">
                                    @if (empty($productdetails->color))
                                    @else
                                        <div class="col-12 col-md-12 colorpart mb-2">
                                            <div class="d-flex">
                                                <h4 id="resellerprice" class="m-0"><b style="font-size:20px">কালার:&nbsp;&nbsp;&nbsp;</b></h4>
                                                <div class="colorinfo">
                                                    @forelse (json_decode($productdetails->color) as $color)
                                                        <input type="radio" class="m-0" id="color{{ $color }}" hidden name="color" onclick="getcolor('{{ $color }}')">
                                                        <label class="colortext ms-0" id="colortext{{ $color }}" for="color{{ $color }}" style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;" onclick="getcolor('{{ $color }}')">{{ $color }}</label>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                     @php
                                        // JSON ডিকোড করে একটি ভেরিয়েবলে রাখুন, যাতে বারবার ডিকোড করতে না হয়
                                        $sizes = json_decode($productdetails->size, true);
                                    @endphp
                                    
                                    {{-- চেক করুন sizes আসলেই অ্যারে কি না এবং এতে ডাটা আছে কি না --}}
                                    @if (!empty($sizes) && is_array($sizes))
                                        <div class="col-12 col-md-12 colorpart">
                                            <div class="d-flex">
                                                <h4 id="resellerprice" class="m-0">
                                                    <b style="font-size:20px">সাইজ: &nbsp;&nbsp;&nbsp;</b>
                                                </h4>
                                                <div class="sizeinfo">
                                                    @foreach ($sizes as $size)
                                                        <input type="radio" class="m-0" hidden id="size{{ $size }}" name="size" onclick="getsize('{{ $size }}')">
                                                        <label class="sizetext ms-0" id="sizetext{{ $size }}" for="size{{ $size }}" 
                                                               style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;" 
                                                               onclick="getsize('{{ $size }}')">
                                                            {{ $size }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                             
                                     @if (empty($productdetails->weight))
                                    @else
                                        <div class="col-12 col-md-12 colorpart">
                                            <div class="d-flex">
                                                <h4 id="resellerprice" class="m-0"><b style="font-size:20px">{{\App\Models\Basicinfo::first()->weight_name}}: &nbsp;&nbsp;&nbsp;</b></h4>
                                                <div class="sizeinfo">
                                                    @forelse (json_decode($productdetails->weight) as $weightInfo)
                                                        @if(!empty($weightInfo->weight))
                                                            <input type="radio" class="m-0" hidden id="weight{{ $weightInfo->weight }}" name="weight" onclick="getweight('{{ $weightInfo->weight }}','{{ $weightInfo->regular_price ?? 0  }}','{{ $weightInfo->sale_price ?? 0 }}')">
                                                            <label class="weighttext ms-0" id="weightext{{ $weightInfo->weight }}" for="weight{{ $weightInfo->weight }}" style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;" onclick="getweight('{{ $weightInfo->weight }}','{{ $weightInfo->regular_price ?? 0 }}','{{ $weightInfo->sale_price ?? 0 }}')">{{ $weightInfo->weight }}</label>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div><div class="quantity-container info-container text-center" style="width: 100%; border-bottom: 1px solid #dfd6d6; float: left;">

    <div class="row mx-0 px-2 mt-2" style="row-gap: 12px;">
        <div class="col-6 px-1">
            <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data" style="width: 100%; margin: 0; padding: 0;">
                @method('POST')
                @csrf
                <input type="text" name="color" id="product_color_bye" hidden>
                <input type="text" name="size" id="product_size_bye" hidden>
                <input type="text" name="weight" id="product_weight" hidden>
                <input type="text" name="sale_price" id="product_weight_salePrice_bye" hidden>
                <input type="text" name="rg_price" id="product_weight_regularPrice_bye" hidden>
                <input type="text" name="product_id" value="{{ $productdetails->id }}" hidden>
                <input type="text" name="qty" value="1" id="qtyorWeight" hidden>

                <button type="submit" class="btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now" 
                    style="background:{{\App\Models\Basicinfo::first()->order_now_bg_color}}; border:1px solid {{\App\Models\Basicinfo::first()->order_now_bg_color}}; color:white; width: 100%; font-size: 16px; height: 50px; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-bottom: 0 !important;">
                    
                    <i class="spinner fa fa-spinner fa-spin mr-1"></i>
                    @if(Agent::isMobile()) 
                        &nbsp; অর্ডার করুন
                    @else
                        &nbsp;&nbsp;&nbsp;অর্ডার করুন
                    @endif
                </button>
            </form>
        </div>

        @php
            $productUrl = url('product/' . $productdetails->ProductSlug);
            $price = $productdetails->ProductSalePrice;
            $message = $productUrl."\n\n".
                       "I am interested in this product.\n\n".
                       "🛍️ Product: ".$productdetails->ProductName."\n\n".
                       "🛍️ Code: ".$productdetails->ProductSku."\n\n".
                       "💰 Price: ৳".$price;

            $whatsappLink = "https://api.whatsapp.com/send?phone=8801636600500&text=" . rawurlencode($message);
        @endphp

        @if(Agent::isMobile())
           

            <div class="col-6 px-1">
                <a class="btn btn-success" id="formText" href="tel:{{App\Models\Basicinfo::first()->phone_one}}" 
                    style="font-size: 16px; font-weight: bold; height: 50px; width: 100%; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="margin-right: 6px;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    কল করুন
                </a>
            </div>
        @else 
            <div class="col-6 px-1">
                <a href="{{ $whatsappLink }}" target="_blank" class="btn btn-success"
                    style="font-size:16px; font-weight:bold; height: 50px; line-height: 20px; width: 100%; background:#49c958; border:1px solid #49c958; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" style="width: 20px; height: 20px; margin-right: 6px;">
                    WhatsApp এ অর্ডার করুন
                </a>
            </div>

           
        @endif

    </div> </div> <style>
    @media (max-width: 767px) {
        .buy-now {
            height: 42px !important; 
            font-size: 14px !important; 
        }
        .quantity-container .btn-success {
            height: 42px !important;
            font-size: 13px !important;
        }
    }
</style>
                                <div class="quantity-container info-container text-center"
                                    style="border-bottom: 1px solid #dfd6d6;">
                                    <div class="row no-gutters pt-2">
                                        <div class="col-2 col-sm-2" style="margin-top: -2px;">
                                            <div class="product-description-label mt-2">Charge:</div>
                                        </div>
                                        <div class="col-10 col-sm-10">
                                            <div class="product-description-label"
                                                style="font-size: 13px;text-align: left;color: gray;">
                                                <i class="fas fa-dot-circle " style="padding-right: 4px;"></i>ঢাকা
                                                সিটির মধ্যে ডেলিভারি চার্জ
                                                {{ $numto->bnNum($shipping->inside_dhaka_charge) }}
                                                টাকা<br>
                                                <i class="fas fa-dot-circle" style="padding-right: 4px;"></i>ঢাকা
                                                সিটির বাইরে ডেলিভারি চার্জ
                                                {{ $numto->bnNum($shipping->outside_dhaka_charge) }} টাকা
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <!-- CSS ওভাররাইড (কোনো থিম বুটস্ট্র্যাপের কালার পরিবর্তন করলেও এটি সাদা রাখবে) -->
<style>
    .btn-success:hover {
        color: #ffffff !important;
    }
    .btn-success:hover svg {
        stroke: #ffffff !important;
    }
</style>
                                
                                 <p style="margin-top:10px; font-weight:bold">{!! $productdetails->ProductBreaf !!}</p>

                            </div>
                            <!-- /.product-info -->
                        </div> 
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.col -->
            <div class="clearfix"></div>
        </div>
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
