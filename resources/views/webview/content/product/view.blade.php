<style>
    #featureimageCt { 
        height: auto;
        width: auto;
        padding: 2px;
        padding-top: 0;
    }
    @media only screen and (max-width: 600px) {
       #featureimageCt {
           height: auto;
            width: auto;
            padding: 2px;
            padding-top: 0;
        }
    }
</style>
<div class="row pt-2 pb-2" style="background: white;">

    @forelse ($categoryproducts as $categoryproduct)
    
  
        <div class="col-6 col-lg-2 mb-4">
            <div class="product">
                <div class="product-micro">
                    <div class="row product-micro-row">
                        <div class="col-12">
                            <div class="product-image"  style="position: relative;">
                                <div class="image text-center">
                                    <a href="{{ url('product/' . $categoryproduct->ProductSlug) }}">
                                        <img src="{{ asset($categoryproduct->ProductImage) }}"
                                            alt="{{ $categoryproduct->ProductName }}" id="featureimageCt" >
                                    </a>
                                </div>
                                <span id="discountpart"> <span id="discountparttwo"> <p id="pdis">-{{ $categoryproduct->Discount }}%</p> </span></span>
                            </div>
                            <!-- /.product-image -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <div class="infofe p-md-3 p-2" style="padding-bottom: 4px !important;">
                                <div class="product-info p-0">
                                    <h2 class="name text-truncate" id="f_name"><a
                                            href="{{ url('product/' . $categoryproduct->ProductSlug) }}"
                                            id="f_pro_name">{{ $categoryproduct->ProductName }}</a></h2>
                                </div>
                                <div class="price-box">
                                    @if ( $categoryproduct->is_weight == 0)
                                    <del class="old-product-price strong-400">৳
                                        {{ round($categoryproduct->ProductRegularPrice) }}</del>
                                    <span class="product-price strong-600">৳
                                        {{ round($categoryproduct->ProductSalePrice) }}</span>
                                        
                                    @endif
                                        
                                            @if (!empty($categoryproduct->weight) && $categoryproduct->is_weight == 1)
                                                @php  $weightInfo = json_decode($categoryproduct->weight); @endphp
                                                @if(!empty($weightInfo[0]->weight))
                                                 <del class="old-product-price strong-400">৳
                                                    {{ round($weightInfo[0]->regular_price ) }}</del>
                                                <span class="product-price strong-600">৳
                                                    {{ round($weightInfo[0]->sale_price) }}</span>
                                                   <span class="weight_code"> {{ $weightInfo[0]->weight ?? '' }}</span>
                                                @endif
                                            @endif
                                        
                                </div>
                            </div>
                             @if (!empty($categoryproduct->weight) && $categoryproduct->is_weight == 1)
                                <form name="form" action="{{url('add-to-cart')}}" method="POST" enctype="multipart/form-data"
                                    style="width: 100%;float: left;text-align: center;">
                                    @method('POST')
                                    @csrf
                                    <input type="text" name="color" id="product_colorold" hidden>
                                    <input type="text" name="size" id="product_sizeold" hidden>
                                    <input type="text" name="product_id" value=" {{ $categoryproduct->id }}"
                                        hidden>
                                    <input type="text" name="qty" value="1" id="qtyor" hidden>
                                    @if (!empty($categoryproduct->weight) && $categoryproduct->is_weight == 1)
                                        @php  $weightInfo = json_decode($categoryproduct->weight); @endphp
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
                                <input type="text" name="product_id" value=" {{ $categoryproduct->id }}"
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
    @empty
        <h2 class="p-4 text-center"><b>No Products found...</b></h2>
    @endforelse
</div>
