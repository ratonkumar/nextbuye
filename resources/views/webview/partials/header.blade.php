@php
    use Jenssegers\Agent\Facades\Agent;
    $isMobile = Agent::isMobile();
@endphp
@if($isMobile)
<header class="header-style-1">

    <!-- /.header-top  id="d-lg-none"-->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="col-12">
        <h5 behavior="" direction="" style="    color: #fff;
    background: #000;
    text-align: center;
    display: block;
    padding: 10px 5px;
    font-size: 14px;
    margin-top: 0px;
    margin-bottom: 0px;"> {{ $basicinfo->marquee_text }}</h5>
    </div> 
    <header class="custom-header" id="myHeader">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-lg-2">
                    <a href="{{ url('/') }}" class="logo-link">
                        <img src="{{ asset($basicinfo->logo) }}" alt="Logo" style="width: 53px;">
                    </a>
                </div>

                <div class="col-4 col-lg-2">
                    <h3 class="next-buye">Next Buy </h3>
                </div>
                <div class="col-4 col-lg-4 d-flex justify-content-end align-items-center">
                    
                    <div class="cart-wrapper">
                        <a href="#" onclick="checkcart(this)">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="cart-count">{{ count(Cart::content()) }}</span>
                        </a>
                    </div>
                
                </div>
            </div>
        </div>
    </header>
</header>

@else
<header class="header-style-1">

    <!-- /.header-top  id="d-lg-none"-->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="col-12">
        <h5 behavior="" direction="" style="    color: #fff;
    background: #000;
    text-align: center;
    display: block;
    padding: 10px 5px;
    font-size: 14px;
    margin-top: 0px;
    margin-bottom: 0px;"> {{ $basicinfo->marquee_text }}</h5>
    </div> 
    <header class="custom-header" id="myHeader">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-lg-2">
                    <a href="{{ url('/') }}" class="logo-link">
                        <img src="{{ asset($basicinfo->logo) }}" alt="Logo" style="width: 53px;">
                    </a>
                </div>

                <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                    <nav class="nav-links">
                        <a href="#">Trending</a>
                        <a href="#">Shop</a>
                        <a href="#">Categories</a>
                        <a href="#" class="active-link">Deals</a>
                    </nav>
                </div>

                <div class="col-8 col-lg-4 d-flex justify-content-end align-items-center">
                    <button class="header-icon-btn" onclick="openSearch()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    
                    <div class="cart-wrapper">
                        <a href="#" onclick="checkcart(this)">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="cart-count">{{ count(Cart::content()) }}</span>
                        </a>
                    </div>
                    @if(!empty($productdetails->id))
                    <a href="#" class="btn-order-now" onclick="buynow('{{ $productdetails->id ?? 0 }}', 1)">Order Now</a>
                    @endif
                </div>
            </div>
        </div>
    </header>
</header>

@endif
