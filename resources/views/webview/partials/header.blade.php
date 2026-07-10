<header class="header-style-1">

    <!-- /.header-top  id="d-lg-none"-->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="col-12">
        <h5 behavior="" direction="" style="color:#818a91"> {{ $basicinfo->marquee_text }}</h5>
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
                            <img src="{{ asset($basicinfo->logo) }}" alt="" id="logosm" style="    width: 53px;
    margin-bottom: 7px;">
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

                    <a type="button" class="search-button d-lg-none" data-bs-toggle="modal"
                        data-bs-target="#searchPopup" style="float: right;font-size: 23px; color: #b9b9b9;"
                        href="#" id="smsericon"> <i class="fas fa-search"
                            style="margin-top: 6px;margin-left: 7px;color:#F27336"></i></a>
                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>

</header>

<!-- Search Popup Modal -->
<div class="modal fade" id="searchPopup" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px !important">
            <div class="modal-body" style="padding: 0px;">
                <div class="modalsearch-area">
                    <div class="control-group d-flex justify-content-between">
                        <input class="search-field mb-0" id="modalsearchinput" onkeyup="searchproduct()"
                            placeholder="Search here...">
                        <a class="search-button" data-bs-dismiss="modal" href="#"></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="searchproductlist" style="background: white;margin: 10px;height: auto;overflow: scroll;">

    </div>
</div>

