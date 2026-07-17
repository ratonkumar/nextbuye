@extends('webview.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}-Checkout
    @endsection

    {{-- //no cart --}}
    @if (!Session::has('cart'))
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="card py-3 mt-sm-3" style="min-height: 309px;">
                    <div class="card-body text-center">
                        <h2 class="h4 pb-3">কোন প্রোডাক্ট নেই</h2>
                        <a class="btn btn-primary mt-3" href="{{ url('/') }}">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Cart::count() == 0)
        <div class="container pb-5 mb-sm-4">
            <div class="pt-5">
                <div class="card py-3 mt-sm-3" style="min-height: 309px;">
                    <div class="card-body text-center">
                        <h2 class="h4 pb-3">কোন প্রোডাক্ট নেই</h2>
                        <a class="btn btn-primary mt-3" href="{{ url('/') }}">প্রোডাক্ট বাছাই করুন</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <br>
        <section class="section-content padding-y bg slidetop">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-6">
                        <aside class="card mb-4">
                            <article class="card-body">
                              
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
                                      <div class="form-group col-sm-12">
                                        <label>অর্ডার সম্পর্কে নোট</label>
                                        <textarea id="customerNotes" name="customerNotes" 
                                                  class="form-control" rows="1" 
                                                  placeholder="অর্ডার বা প্রোডাক্ট সম্পর্কে কোনো নোট">@if(Auth::id()){{-- যদি আগে থেকে কোনো নোট দেখাতে চান --}}@endif</textarea>
                                    </div>
                                        <textarea id="ordersubtotalprice" name="subTotal" cols="10" rows="5"
                                                  hidden>{{ Cart::subtotalFloat() }}</textarea>
                                        <div class="form-group col-sm-12">
                                            <label>Select Area </label>
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
                                                    style="background:green;border:1px solid green; color:white;font-size:30px; width: 100% !important;">
                                                <i class="spinner fa fa-spinner fa-spin"></i> অর্ডার কনফার্ম করুন
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                    <button id="sslczPayBtn"  class="btn btn-lg btn-styled from-prevent-multiple-submits btn-base-1 btn-block btn-icon-left strong-500 hov-bounce hov-shaddow buy-now"
                                            token="if you have any token validation" style="display: none; background:green;color:white;font-size:30px; width: 100% ;height: 60px !important;"
                                            postdata=""
                                            order="If you already have the transaction generated for current order"
                                            endpoint="{{url('/pay-via-ajax')}}"> Pay Now
                                    </button>
                                        </div>
                                    </div>
                                </form>
                            </article> <!-- card-body.// -->
                        </aside>
                    </div>
                    <div class="col-md-6 orderDetails">
                        <aside class="card">


                            <article class="card-body">
                                <header class="mb-4">
                                    <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
                                </header>
                                <div class="row">
                                    <table class="table border-bottom">
                                        @forelse ($cartProducts as $cartProduct)
                                            <tr class="cart-item" id="productcart{{ $cartProduct->rowId }}">
                                                <td class="product-image" id="proImgDiv">
                                                    <a href="#" class="mr-3">
                                                        <img class=" ls-is-cached lazyloaded"
                                                             src="{{ asset($cartProduct->image) }}" id="proImg">
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
                                                                {{ $cartProduct->price }}</span>
                                                        </div>
                                                        <div class="qtyinfo">
                                                            <div class="input-group input-group--style-2 pr-4"
                                                                 style="width: 130px;float:left">
                                                                <span class="input-group-btn">
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
                                                                       onchange="updateQuantity('{{ $cartProduct->rowId }}', this)">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number"
                                                                            onclick="updatenum('{{$cartProduct->rowId}}')"
                                                                            id="äddqty" type="button">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            <a type="button" id="proDelCart"
                                                               style="width: 30px;font-size: 18px;"
                                                               onclick="removeFromCart('{{ $cartProduct->rowId }}')"
                                                               class="text-right pl-4">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <input type="text" name="productP" id="priceOf{{ $cartProduct->rowId }}"
                                                       value="{{ $cartProduct->price }}" hidden>

                                            </tr>
                                        @empty
                                        @endforelse
                                    </table>
                                </div>
                            </article>

                            <input type="text" name="size" value="{{ $cartProduct->options->size }}" hidden>
                            <input type="text" name="color" value="{{ $cartProduct->options->color }}" hidden>
                            <article class="card-body border-top">
                                <dl class="row mb-0">
                                    <!-- Subtotal -->
                                    <dt class="col-7 col-sm-8">Subtotal:</dt>
                                    <dd class="col-5 col-sm-4 text-end text-right">
                                        <strong>৳ <span id="subtotalprice">{{ Cart::subtotalFloat() }}</span></strong>
                                    </dd>

                                    <!-- Delivery Charge -->
                                    <dt class="col-7 col-sm-8">Delivery charge:</dt>
                                    <dd class="col-5 col-sm-4 text-danger text-end text-right">
                                        <strong>৳ 
                                            @if (isset($product->inside_dhaka))
                                                <span id="dinamicdalivery">{{ $product->inside_dhaka }}</span>
                                            @else
                                                <span id="dinamicdalivery">{{ App\Models\Basicinfo::first()->inside_dhaka_charge }}</span>
                                            @endif
                                        </strong>
                                    </dd>

                                    <!-- Total -->
                                    <dt class="col-7 col-sm-8">Total:</dt>
                                    <dd class="col-5 col-sm-4 text-end text-right">
                                        <strong class="h5 text-dark">৳ <span id="totalamount"></span></strong>
                                    </dd>
                                </dl>
                            </article>

                        </aside>
                    </div>

                </div>
            </div>
        </section>
    @endif


    <style>
        /*.spinner {*/
        /*    display: none;*/
        /*}*/

        @media only screen and (min-width: 768px) {
            #proName {
                font-size: 18px;
            }

            #proPrice {
                font-size: 18px;
                padding: 6px;
                padding-left: 0;
            }

            .input-number {
                height: 39px;
            }

            #proDelCart {
                width: 30px;
                padding-top: 2px;
                font-size: 20px;
            }

            #proImgDiv {
                max-width: 110px;
            }

            #proImg {
                max-width: 100px;
            }

        }

        @media only screen and (max-width: 767px) {
            .input-group--style-2 .input-group-btn > .btn {
                background: 0 0;
                border-color: #e6e6e6;
                color: #818a91;
                font-size: 8px;
                padding-top: 6px;
                padding-bottom: 6px;
                cursor: pointer;
            }

            .input-number {
                height: 26px;
            }

            #proDelCart {
                width: 30px;
                font-size: 18px;
            }

            #proImg {
                max-width: 50px;
            }
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script>
        function showCashOnDelivery() {
            document.getElementById("orderConfirm").style.display = "block";
            document.getElementById("sslczPayBtn").style.display = "none";
        }

        function showOnlinePay() {
            document.getElementById("orderConfirm").style.display = "none";
            document.getElementById("sslczPayBtn").style.display = "block";
        }
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#sslczPayBtn', function (e) {
                
               e.preventDefault();
               
                var name = $('#customerName').val();
                var phone = $('#customerPhone').val();
                var address = $('#customerAddress').val();

                if (!name || !phone || !address) {
                    // alert('Please fill in all required fields.');
                    return; // Prevent the rest of the code from running
                }
               
                var obj = {};
                obj.cus_name = $('#customerName').val();
                obj.cus_phone = $('#customerPhone').val();
                obj.cus_email = 'dumy@gmail.com';
                obj.cus_addr1 = $('#customerAddress').val();
                obj.amount = $('#totalamount').html();
                obj.deliveryCharge= $('#deliveryCharge').val();

                $('#sslczPayBtn').prop('postdata', obj);
                
                console.log(obj)
            })
        })
    </script>

{{--    <script>--}}

{{--        (function (window, document) {--}}
{{--            var loader = function () {--}}
{{--                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];--}}
{{--                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);--}}
{{--                tag.parentNode.insertBefore(script, tag);--}}
{{--            };--}}

{{--            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);--}}
{{--        })(window, document);--}}
{{--    </script>--}}

    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    
    
    <script>


        function updatenum(id) {
            var num = $('#QuantityPeo' + id).val();
            var fv = Number(num) + 1;
            if (fv > 9) {

            } else {
                $('#QuantityPeo' + id).val(fv);
                $.ajax({
                    type: 'POST',
                    url: 'update-cart',

                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: id,
                        qty: fv,
                    },

                    success: function (data) {
                        $('#QuantityPeo' + id).val(data.qty);
                        updateQuantity(id);

                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            }
        }

        function remnum(id) {
            var num = $('#QuantityPeo' + id).val();
            var fv = Number(num) - 1;
            if (fv < 1) {

            } else {
                $('#QuantityPeo' + id).val(fv);
                $.ajax({
                    type: 'POST',
                    url: 'update-cart',

                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: id,
                        qty: fv,
                    },

                    success: function (data) {
                        $('#QuantityPeo' + id).val(data.qty);
                        updateQuantity(id);

                    },
                    error: function (error) {
                        console.log('error');
                    }
                });

            }

        }

        function setdeliverychargr() {
            var deliverycharge = $('#deliveryCharge').val();
            $('#dinamicdalivery').html(deliverycharge);

            var subprice = $('#subtotalprice').html();
            var totalprice = subprice - (-deliverycharge);
            $('#totalamount').html(totalprice)
        }

        function updateQuantity(rowId) {
            var quantity = $('#QuantityPeo' + rowId).val();
            var price = $('#priceOf' + rowId).val();
            var producttotal = quantity * price;

            var prevPrice = $('#pricetotal' + rowId).html();
            if (producttotal > prevPrice) {
                var subPrice = $('#subtotalprice').html();
                var updatesubprice = subPrice - (-price);
                $('#subtotalprice').html(updatesubprice);
                //ordersubtotal
                $('#ordersubtotalprice').html(updatesubprice);
                //cart number
                var prevcart = $('#cartNumber').html();
                var cartUpdate = prevcart - (-1);
                $('#cartNumber').html(cartUpdate);

            } else {
                //cart number
                var prevcart = $('#cartNumber').html();
                var cartUpdate = prevcart - 1;
                $('#cartNumber').html(cartUpdate);

                var subPrice = $('#subtotalprice').html();
                var updatesubprice = subPrice - price;
                $('#subtotalprice').html(updatesubprice);
                $('#ordersubtotalprice').html(updatesubprice);

            }
            //mincart
            $('#minQty' + rowId).html(quantity);
            $('#minsubtotalprice').html(updatesubprice);
            //total price part
            var deliverycharge = $('#deliveryCharge').val();
            var totalprice = updatesubprice - (-deliverycharge);
            $('#totalamount').html(totalprice);


            $('#pricetotal' + rowId).html(producttotal);

            $.ajax({
                type: 'POST',
                url: 'update-cart',

                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                    qty: quantity,
                },

                success: function (data) {
                    $('#QuantityPeo' + rowId).val(data.qty);

                },
                error: function (error) {
                    console.log('error');
                }
            });

        }

        function removeFromCart(rowId) {
            var thisprice = $('#pricetotal' + rowId).html();
            var subPrice = $('#subtotalprice').html();
            var updatesubprice = subPrice - thisprice;
            $('#subtotalprice').html(updatesubprice);

            //order subtotal
            $('#ordersubtotalprice').html(updatesubprice);

            var deliverycharge = $('#deliveryCharge').val();
            var totalprice = updatesubprice - (-deliverycharge);
            $('#totalamount').html(totalprice);
            //cart number
            var quantity = $('#QuantityPeo' + rowId).val();
            var prevcart = $('#cartNumber').html();
            var cartUpdate = prevcart - quantity;
            $('#cartNumber').html(cartUpdate);

            $.ajax({
                type: 'POST',
                url: 'remove-cart',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                },

                success: function (data) {
                    $('#productcart' + rowId).css('display', 'none');
                    if (data == 'empty') {
                        location.reload();
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        window.onload = (event) => {
            var subPrice = $('#subtotalprice').html();
            //total price part
            var deliverycharge = $('#deliveryCharge').val();
            var totalprice = subPrice - (-deliverycharge);
            $('#totalamount').html(totalprice)

        };
    </script>

    <script type="text/javascript">
        (function () {
            $('.from-prevent-multiple-submits').on('submit', function () {
                $('.from-prevent-multiple-submits').attr('disabled', 'true');
                $('.spinner').css('display', 'inline');
            })
        })();
    </script>

@endsection
