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
    <div class="main-header" id="myHeader" style="background: #fff;border-bottom: 1px solid #e9e9e9;">
        <div class="container">
            <div class="row" style="margin: 0">
                <div class="col-9 col-sm-9 col-md-9 col-lg-3 logo-holder ps-0">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo">
                        <button type="button" onclick="openNav()" id="menubutton" class="d-lg-none">
                            <img src="{{asset('public/menuooo.png')}}" style="width:40px">
                        </button>

                        <a href="{{ url('/') }}" id="logoimage">
                            <img src="{{ asset($basicinfo->logo) }}" alt="" id="logosm" style="width: 53px;margin-bottom: 7px;">
                        </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <!-- /.top-search-holder -->
                <div class="col-3 col-sm-3 col-md-3  col-lg-3 animate-dropdown top-cart-row p-0">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                    <div class=" dropdown-cart" style="padding-left: 14px;">
                        <a href="#" class="dropdown" onclick="checkcart(this)" data-bs-toggle="dropdown"
                            id="smcarticon">
                            <div class="items-cart-inner">
                                <div class="basket" style="padding: 0;padding-top: 2px;display:flex;">
                                    <i class="fa-solid fa-basket-shopping" style="color: #F27336;font-size: 28px;"></i>
                                    <span class="d-none d-lg-block lbl"
                                        style="color: black;font-size: 13px;margin-top:13px">Cart</span>
                                </div>
                                <div class="nav-box-number" id="d-sm-none"><span
                                        class="count">{{ count(Cart::content()) }}</span></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li id="checkcartview">
                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->
 
                    <div class="d-none d-lg-inline-block" id="d-sm-none" style="float:right;padding-right: 15px;">
                        <div class="nav-wishlist-box" id="wishlist" style="    float: right;">
                            <a href="tel:09613100400" class="nav-box-link">
                                <i class="fa-solid fa-heart" id="bookmarkicon" style="color:#F27336"></i>  
                            </a>
                        </div>
                    </div>

                  </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
</header>
