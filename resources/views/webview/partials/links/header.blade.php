<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- font awsam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css"
    integrity="sha512-R+xPS2VPCAFvLRy+I4PgbwkWjw1z5B5gNDYgJN5LfzV4gGNeRQyVrY7Uk59rX+c8tzz63j8DeZPLqmXvBxj8pA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- carousel -->
<link rel="stylesheet" href="{{ asset('public/webview/assets') }}/carousel/css/docs.theme.min.css">
<link rel="stylesheet" href="{{ asset('public/webview/assets') }}/carousel/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="{{ asset('public/webview/assets') }}/carousel/owlcarousel/assets/owl.theme.default.min.css">
<!-- Carousel js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/webview/assets') }}/carousel/owlcarousel/owl.carousel.js"></script>
<!-- style.css -->
<link rel="stylesheet" href="{{ asset('public/webview/assets') }}/css/style.css">
{{-- toaster --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
    .dropdown:hover>.dropdown-menu {
        display: block !important;
    }
    
    .bottom-navbar {
        background: {{\App\Models\Basicinfo::first()->header_bg_color}};
    }
    .product-price, .search-button svg {
        color: {{\App\Models\Basicinfo::first()->button_color}} !important;
    }
    .side-menu-header,.search-button {
        background: {{\App\Models\Basicinfo::first()->categories_bg_color}};
    }
    #bookmarkicon,svg.svg-inline--fa.fa-basket-shopping,#productPriceAmount {
        color: {{\App\Models\Basicinfo::first()->button_color}} !important;
    }
    button#purcheseBtn,a.btn.btn-danger.btn-sm.mb-0,.main-header .top-search-holder .search-area .search-button,.nav-box-number,.btn-base-1,span.weight_code {
        background: {{\App\Models\Basicinfo::first()->button_color}};
        border: 1px solid {{\App\Models\Basicinfo::first()->button_color}};
      
    }
    #catimg {
    
        border: 4px solid {{\App\Models\Basicinfo::first()->button_color}};
    }
    .footer .footer-bottom {
        background: {{\App\Models\Basicinfo::first()->footer_bg_color}};
        padding-top: 30px;
        padding-bottom: 30px;
    }
    
    #menu a:hover {
        background-color: {{\App\Models\Basicinfo::first()->header_menu_hover_color}};
        
    }

    .sidebar .side-menu .head {
    
        background-color: {{\App\Models\Basicinfo::first()->categories_bg_color}};
        border: 1px solid {{\App\Models\Basicinfo::first()->categories_bg_color}};
        font-weight: 700;
        letter-spacing: 0.5px;
        border-bottom: 1px {{\App\Models\Basicinfo::first()->categories_bg_color}} solid;
    }
</style>
