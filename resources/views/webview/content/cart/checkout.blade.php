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
        <div class="container py-4">
            <!-- Back to cart link -->
            <a href="{{ url('/cart') }}" class="text-decoration-none text-muted mb-3 d-block">
                &larr; Back to cart
            </a>
            
            <!-- Title and Subtitle -->
            <h1 class="fw-bold mb-2">Checkout</h1>
            <p class="text-muted">No account needed — just your delivery details. Pay cash when it arrives.</p>
        </div>
        <section class="section-content padding-y bg slidetop">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-8">
                        <aside class="card mb-4">
                            <article class="card-body">
                                <h2 class="delivery-details" style="font-size: 25px; font-weight: bold; margin-bottom: 10px !important;">Delivery details</h2>
                                <form action="{{ url('press/order') }}" method="POST"  class="from-prevent-multiple-submits" id="orderForm">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>Full name</label>
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
                                            <label>Phone number</label>
                                            <input type="text" minlength="11" maxlength="11"
                                                   pattern="[0-1]{2}[0-9]{6}[0-9]{3}" id="customerPhone"
                                                   @if(Auth::id()) value="{{Auth::guard('web')->user()->phone}}"
                                                   @else @endif  name="customerPhone" required
                                                   class="form-control" placeholder="আপনার মোবাইল লিখুন">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Full address </label>
                                            <input type="text" id="customerAddress" name="customerAddress"
                                                   placeholder="আপনার ঠিকানা লিখুন" required class="form-control"
                                                   style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                        </div>
                                       
                                      <div class="form-group col-sm-12">
                                        <label>Email (optional)</label>
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
                                           
                                            </ul>
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
                    <div class="col-md-4 orderDetails">
                        <div class="card shadow-sm border-0 rounded-4 p-4">
                            <h4 class="fw-bold mb-4">Your order</h4>

                            <!-- Cart Items -->
                            @foreach ($cartProducts as $cartProduct)
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($cartProduct->image) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">{{ $cartProduct->name }}</div>
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="input-group input-group-sm checkout-qty" style="width: 100px;">
                                            <!-- বাটনগুলোতে rowId পাস করা হয়েছে -->
                                            <button class="btn btn-outline-secondary plus-munus" type="button" onclick="remnum('{{$cartProduct->rowId}}')">-</button>
                                            
                                            <!-- ইনপুট ফিল্ডে আইডি দেওয়া হয়েছে -->
                                            <input type="text" id="QuantityPeo{{$cartProduct->rowId}}" class="form-control qty-checkout text-center" value="{{ $cartProduct->qty }}" readonly>
                                            
                                            <button class="btn btn-outline-secondary plus-munus" type="button" onclick="updatenum('{{$cartProduct->rowId}}')">+</button>
                                        </div>
                                        <a href="javascript:void(0)" onclick="removeFromCart('{{ $cartProduct->rowId }}')" class="ms-3 text-muted text-decoration-none small">Remove</a>
                                    </div>
                                </div>
                                <!-- এখানে প্রাইস ক্যালকুলেশনের জন্য আইডি দেওয়া হয়েছে -->
                                <div class="fw-bold">৳<span id="pricetotal{{$cartProduct->rowId}}" class="item-total">{{ $cartProduct->qty * $cartProduct->price }}</span></div>
                                <!-- জাভাস্ক্রিপ্টের হিসাবের জন্য হিডেন প্রাইস ফিল্ড -->
                                <input type="hidden" id="priceOf{{$cartProduct->rowId}}" value="{{ $cartProduct->price }}">
                            </div>
                            @endforeach

                            <hr>

                            <!-- Subtotal -->
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span> 
                                <strong>৳<span id="subtotalprice">{{ Cart::subtotalFloat() }}</span></strong>
                            </div>

                            <!-- Delivery -->
                            <div class="d-flex justify-content-between mb-3">
                                <span>Delivery</span> 
                                <strong>৳<span id="dinamicdalivery">0</span></strong>
                            </div>

                            <!-- Total -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold">Total</h4>
                                <h4 class="fw-bold text-danger">৳<span id="totalamount">0</span></h4>
                            </div>

                            <button type="submit" id="orderConfirm" class="btn btn-danger w-100 py-3 fw-bold fs-5">
                                Place Order · ৳<span id="btnTotal">0</span>
                            </button>

                            <ul class="list-unstyled mt-4">
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="fas fa-check me-2" style="color: #000;"></i> 
                                    <span class="text-dark">No advance payment required</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="fas fa-check me-2" style="color: #000;"></i> 
                                    <span class="text-dark">7-day easy returns</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <i class="fas fa-check me-2" style="color: #000;"></i> 
                                    <span class="text-dark">We call to confirm every order</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
 <style>
    .rounded-4 { border-radius: 1.5rem !important; }
    .btn-danger { background-color: #f0532b !important; border: none; }
 </style>
<script>
function calculateTotals() {
    // সাবটোটাল টেক্সট থেকে নাম্বার বের করা
    let subtotalText = $('#subtotalprice').text().trim();
    let subtotal = parseFloat(subtotalText.replace(/[^0-9.]/g, '')) || 0;

    // ডেলিভারি চার্জ থেকে নাম্বার বের করা
    let deliveryText = $('#dinamicdalivery').text().trim();
    let delivery = parseFloat(deliveryText.replace(/[^0-9.]/g, '')) || 0;

    // টোটাল হিসাব
    let total = subtotal + delivery;

    // আপডেট করা
    $('#totalamount').text(total);
    $('#btnTotal').text(total);
}

// পেজ লোড হওয়ার পর কল হবে
$(document).ready(function() {
    calculateTotals();
});

</script>
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
