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
    <header class="custom-header">
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

                    <a href="#" class="btn-order-now">Order Now</a>
                </div>
            </div>
        </div>
    </header>
</header>
