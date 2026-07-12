@extends('webview.master')

@section('maincontent')
@section('title')
    {{ App\Models\Basicinfo::first()->title  }}
@endsection

@section('meta')
    @php
        // Fetch the data from the database
        $basicinfo = \App\Models\Basicinfo::first();
        $baseUrl = url('/');
        $logoUrl = url($basicinfo->logo);
        $siteName = "Best Buye";
        $pageTitle = "Best Online Shopping in Bangladesh | " . $siteName;
        $desc = "Online shopping in Bangladesh for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, and more.";
    @endphp

    <meta name="description" content="{{ $desc }}">
    <meta name="keywords" content="Best Buye, online store bd, online shop bd, Organic fruits, Thai, UK, Korea, China, cosmetics, Jewellery, bags, dress, mobile, accessories, automation Products">

    <meta itemprop="name" content="{{ $pageTitle }}">
    <meta itemprop="description" content="{{ $desc }}">
    <meta itemprop="image" content="{{ $logoUrl }}">

    <meta property="og:url" content="{{ $baseUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:image" content="{{ $logoUrl }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:url" content="{{ $baseUrl }}">
    <meta name="twitter:image" content="{{ $logoUrl }}">
@endsection


<div class="container">
    <div class="row bg-white">
        <div class="col-12">
            <div class="owl-carousel owl-theme" id="slider">
                @forelse ($sliders as $slider)
                    <div class="item" style="margin:0 !important;">
                        <img  src="{{ asset($slider->slider_image) }}"
                            alt="{{ $slider->slider_title }}">
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
<section class="shop-section py-5">
    <div class="container">
        <div class="filter-buttons mb-4">
            <button class="btn btn-dark rounded-pill px-4 filter-btn active" data-filter="all">All</button>
            @foreach($categoryproducts as $category)
                <button class="btn btn-outline-secondary rounded-pill px-4 filter-btn" data-filter="cat-{{ $category->id }}">
                    {{ $category->category_name }}
                </button>
            @endforeach
        </div>

        <div class="row" id="product-container">
            @foreach($categoryproducts as $category)
                @php
                    echo "<pre>";
                    print_r($category->products);
                    echo "</pre>";    
                @endphp
                @foreach($category->products as $product)
                    <div class="col-12 col-md-4 col-lg-3 product-item" data-cat="cat-{{ $category->id }}">
                        <div class="product-card border p-2 mb-4">
                            <img src="{{ asset($product->ViewProductImage) }}" class="img-fluid" alt="{{ $product->ProductName }}">
                            <h5>{{ $product->ProductName }}</h5>
                            <p>৳{{ $product->ProductSalePrice }}</p>
                            <form action="{{url('add-to-cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary w-100">Order Now</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@if(count($featuredproducts) > 0)
<!-- Promotional Products -->
<div class="container pt-0 pb-4">
    <div class="row bg-white pb-4">
        <div class="col-12" style="border-bottom: 1px solid {{ \App\Models\Basicinfo::first()->button_color }};padding-left: 0;display: flex;justify-content: space-between;">
            <div class="px-2 p-md-3 pt-0 d-flex justify-content-between" style="padding-bottom:4px !important;padding-top: 8px !important;">
                <h4 class="m-0"><b>Featured Products</b></h4>
            </div>
            <a href="{{ url('featured/products') }}" class="btn btn-danger btn-sm mb-0" style="padding: 2px;height: 26px;color: white;font-weight: bold;margin-top:9px;background:{{\App\Models\Basicinfo::first()->button_color}};border:1px solid {{\App\Models\Basicinfo::first()->button_color}}">VIEW ALL</a>
        </div>
        <div class="col-12">
            <div class="owl-carousel " id="featuredProductSlide">
                @forelse ($featuredproducts as $promotional)
                    <div class="item" id="featuredproduct">
                        <div class="products best-product">
                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col-12">
                                            <div class="product-image" style="position: relative;">
                                                <div class="image text-center">
                                                    <a href="{{ url('product/' . $promotional->ProductSlug) }}">
                                                        <img src="{{ asset($promotional->ViewProductImage) }}"
                                                            alt="{{ $promotional->ProductName }}" id="featureimagess">
                                                    </a>
                                                </div>
                                                <span id="discountpart"> <span id="discountparttwo"> <p id="pdis">-{{ $promotional->Discount }}%</p> </span></span>
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <div class="infofe p-md-3 p-2" style="padding-bottom: 4px !important;">
                                                <div class="product-info">
                                                    <h2 class="name text-truncate" id="f_name"><a
                                                            href="{{ url('product/' . $promotional->ProductSlug) }}"
                                                            id="f_pro_name">{{ $promotional->ProductName }}s</a></h2>
                                                            
                                                </div>
                                                <div class="price-box">
                                                    <!--@php print_r($promotional); @endphp-->
                                                    <!--<del class="old-product-price strong-400">৳{{ round($promotional->ProductRegularPrice) }}</del>-->
                                                     
                                                    <span
                                                        class="product-price strong-600"> @if ($promotional->is_weight == 0) ৳{{ round($promotional->ProductSalePrice) }}  @endif 
                                                           @if (!empty($promotional->weight) && $promotional->is_weight == 1)
                                                                @php  $weightInfo = json_decode($promotional->weight); @endphp
                                                                @if(!empty($weightInfo[0]->weight))
                                                                    ৳{{ round($weightInfo[0]->sale_price) }}
                                                                   <span class="weight_code"> {{ $weightInfo[0]->weight ?? '' }}</span>
                                                                @endif
                                                            @endif
                                                    
                                                        </span>
                                                </div>
                                            </div>
                                              
                                            @if ( $promotional->is_weight == 1)
                                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                    style="width: 100%;float: left;text-align: center;">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="text" name="color" id="product_colorold" hidden>
                                                    <input type="text" name="size" id="product_sizeold" hidden>
                                                    <input type="text" name="product_id" value=" {{ $promotional->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    @if (!empty($promotional->weight) && $promotional->is_weight == 1)
                                                        @php  $weightInfo = json_decode($promotional->weight); @endphp
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
                                                    <input type="text" name="product_id" value=" {{ $promotional->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                            style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                                </form>
                                            @endif

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
        </div>
    </div>
</div>
@else

@endif


<div class="container mt-lg-4 mt-2 p-0 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="owl-carousel " id="categorySlide">
                @forelse ($categories as $category)
                    <div class="item">
                        <a href="{{ url('products/category/' . $category->slug) }}" >
                            <div id="cath">
                                <div class="d-flex justify-content-center" >
                                    <img  src="{{ asset($category->category_icon) }}" id="catimg">
                                </div>

                                <p id="catp">{{ $category->category_name }}</p>
                            </div>
                        </a>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- add section -->
<div class="container mb-lg-3 mb-2">
    <div class="row gutters-10">
        @if (count($adds) == '2')
            @forelse ($adds as $add)
                <div class="col-lg-6 col-6 ps-0">
                    <div class="media-banner mb-1 mb-lg-0">
                        <a href="{{ $add->add_link }}" target="_blank" class="banner-container">
                            <img src="{{ asset($add->add_image) }}" alt="{{ env('APP_NAME') }}"
                                class="img-fluid ls-is-cached lazyloaded">
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        @else
            @forelse ($adds as $add)
                <div class="col-lg-12 col-12 ps-0">
                    <div class="media-banner mb-1 mb-lg-0">
                        <a href="{{ $add->add_link }}" target="_blank" class="banner-container">
                            <img src="{{ asset($add->add_image) }}" alt="{{ env('APP_NAME') }}"
                                class="img-fluid ls-is-cached lazyloaded">
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        @endif
    </div>
</div>

@if(count($topproducts)>0)
<!-- Promotional Products -->
<div class="container pt-0 pb-4">
    <div class="row bg-white pb-4">
        <div class="col-12" style="border-bottom: 1px solid {{ \App\Models\Basicinfo::first()->button_color }};padding-left: 0;display: flex;justify-content: space-between;">
            <div class="px-2 p-md-3 pt-0 d-flex justify-content-between" style="padding-bottom:4px !important;padding-top: 8px !important;">
                <h4 class="m-0"><b>Promotional Offers</b></h4>
            </div>
            <a href="{{ url('promotional/products') }}" class="btn btn-danger btn-sm mb-0" style="padding: 2px;height: 26px;color: white;font-weight: bold;margin-top:9px;">VIEW ALL</a>
        </div>
        <div class="col-12">
            <div class="owl-carousel " id="promotionalofferSlide">
                @forelse ($topproducts as $promotional)
                    <div class="item" id="featuredproduct">
                        <div class="products best-product">
                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col-12">
                                            <div class="product-image" style="position: relative;">
                                                <div class="image text-center">
                                                    <a href="{{ url('product/' . $promotional->ProductSlug) }}">
                                                        <img src="{{ asset($promotional->ViewProductImage) }}"
                                                            alt="{{ $promotional->ProductName }}" id="featureimagess">
                                                    </a>
                                                </div>
                                                <span id="discountpart"> <span id="discountparttwo"> <p id="pdis">-{{ $promotional->Discount }}%</p> </span></span>
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                          
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <div class="infofe p-md-3 p-2" style="padding-bottom: 4px !important;">
                                                <div class="product-info">
                                                    <h2 class="name text-truncate" id="f_name"><a
                                                            href="{{ url('product/' . $promotional->ProductSlug) }}"
                                                            id="f_pro_name">{{ $promotional->ProductName }}s</a></h2>
                                                </div>
                                                <div class="price-box">
                                                    <!--<del class="old-product-price strong-400">৳{{ round($promotional->ProductRegularPrice) }}</del>-->
                                                    <span
                                                        class="product-price strong-600">৳{{ round($promotional->ProductSalePrice) }}</span>
                                                </div>
                                            </div>
                                             @if (!empty($promotional->weight) && $promotional->is_weight == 1)
                                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                    style="width: 100%;float: left;text-align: center;">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="text" name="color" id="product_colorold" hidden>
                                                    <input type="text" name="size" id="product_sizeold" hidden>
                                                    <input type="text" name="product_id" value=" {{ $promotional->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    @if (!empty($promotional->weight) && $promotional->is_weight == 1)
                                                        @php  $weightInfo = json_decode($promotional->weight); @endphp
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
                                                <input type="text" name="product_id" value=" {{ $promotional->id }}"
                                                    hidden>
                                                <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                        style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                            </form>
                                            @endif

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
        </div>
    </div>
</div>
@else

@endif

@forelse ($categoryproducts as $key=>$categoryproduct)
 @php 
                        $porductID = DB::table('category_product')->where('category_id',  $categoryproduct->id)->pluck('product_id')->toArray();
                        $category_Products = App\Models\Product::whereIn('id', $porductID)->where('is_sub_product', 0 )->orderBy('order_no','asc')->where('status','Active')->take(12)->get();
                @endphp
    @if (count($category_Products) > 0)
        <!-- Category Products -->
        <div class="container pt-0 pb-4">
            <div class="row bg-white pb-0">
                <div class="col-12" style="border-bottom: 1px solid {{ \App\Models\Basicinfo::first()->button_color }};padding-left: 0;display: flex;justify-content: space-between;">
                    <div class="px-2 p-md-3 pt-0 d-flex justify-content-between" style="padding-bottom:4px !important;padding-top: 8px !important;">
                        <h4 class="m-0"><b>{{ $categoryproduct->category_name }}</b></h4>
                    </div>
                    <a href="{{url('products/category/'.$categoryproduct->slug)}}" class="btn btn-danger btn-sm mb-0" style="padding: 2px;height: 26px;color: white;font-weight: bold;margin-top:9px;background: {{\App\Models\Basicinfo::first()->button_color}};border: 1px solid {{\App\Models\Basicinfo::first()->button_color}};">VIEW ALL</a>
                </div>

               
                @forelse ($category_Products as $product)
                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                        <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col-12">
                                            <div class="product-image" style="position: relative;">
                                                <div class="image text-center">
                                                    <a href="{{ url('product/' . $product->ProductSlug) }}">
                                                        <img src="{{ asset($product->ViewProductImage) }}"
                                                            alt="{{ $product->ProductName }}" id="featureimage">
                                                    </a>
                                                </div>
                                                <span id="discountpart"> <span id="discountparttwo"> <p id="pdis">-{{ $product->Discount }}%</p> </span></span>
                                                <!-- /.image -->
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <div class="infofe p-md-3 p-2" style="border: 1px solid #e3e1e1;border-top:none;">
                                                <div class="product-info">
                                                    <h2 class="name text-truncate" id="f_name"><a
                                                            href="{{ url('product/' . $product->ProductSlug) }}"
                                                            id="f_pro_name">{{ $product->ProductName }}</a>
                                                    </h2>
                                                    
                                                </div>
                                                
                                                <div class="price-box">
                                                    @if ( $product->is_weight == 0)
                                                    <del class="old-product-price strong-400">৳
                                                        {{ round($product->ProductRegularPrice) }}</del>
                                                    <span class="product-price strong-600">৳
                                                        {{ round($product->ProductSalePrice) }}</span>
                                                        
                                                    @endif
                                                        
                                                    @if ( $product->is_weight == 1)
                                                        @php  $weightInfo = json_decode($product->weight); @endphp
                                                        @if(!empty($weightInfo[0]->weight))
                                                        
                                                            <del class="old-product-price strong-400">৳
                                                            {{ round($weightInfo[0]->regular_price ) }}</del>
                                                            <span class="product-price strong-600">৳
                                                            {{ round($weightInfo[0]->sale_price) }}</span>
                                                           <span class="weight_code"> {{ $weightInfo[0]->weight ?? '' }}</span>
                                                        @else 
                                                        
                                                            <del class="old-product-price strong-400">৳
                                                                {{ round($product->ProductRegularPrice) }}</del>
                                                            <span class="product-price strong-600">৳
                                                                {{ round($product->ProductSalePrice) }}</span>
                                                                
                                                        @endif
                                                    @endif
                                                        
                                                </div>

                                            </div>
                                            
                                            @if (!empty($product->weight) && $product->is_weight == 1)
                                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                                    style="width: 100%;float: left;text-align: center;">
                                                    @method('POST')
                                                    @csrf
                                                    <input type="text" name="color" id="product_colorold" hidden>
                                                    <input type="text" name="size" id="product_sizeold" hidden>
                                                    <input type="text" name="is_weight_allow" value="1" id="is_weight_allow" hidden>
                                                    <input type="text" name="product_id" value=" {{ $product->id }}"
                                                        hidden>
                                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                    @if (!empty($product->weight) && $product->is_weight == 1)
                                                        @php  $weightInfo = json_decode($product->weight); @endphp
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
                                                <input type="text" name="product_id" value=" {{ $product->id }}"
                                                    hidden>
                                                    <input type="text" name="is_weight_allow" value="0" id="is_weight_allow" hidden>
                                                <input type="text" name="qty" value="1" id="qtyor" hidden>
                                                <button class="btn btn-danger btn-sm mb-0 btn-block"
                                                        style="width: 100%;border-radius: 0%;" id="purcheseBtn">অর্ডার করুন</button>
                                            </form>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.product-micro-row -->
                                </div>

                                <!-- /.product-micro -->

                            </div>
                    </div>
                @empty
                @endforelse

                </div>
            </div>
        </div>
    @else
    @endif

@empty
@endforelse


@endsection
