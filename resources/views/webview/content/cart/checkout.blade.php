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
                                            <input type="text" id="customerName" name="customerName" placeholder="Please Enter Full Name"  required class="form-control"  style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
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
                                                   class="form-control" placeholder="Please Enter Phone">
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Full address </label>
                                            <input type="text" id="customerAddress" name="customerAddress"
                                                   placeholder="Please Enter Address" required class="form-control"
                                                   style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                        </div>
                                       
                                        <div class="form-group col-sm-12">
                                            <label>Email (optional)</label>
                                            <input id="customerEmail" name="customerEmail"  class="form-control" placeholder="Enter Email Address"></input>
                                        </div>
                                        <label class="form-label fw-bold">Delivery zone</label>
                                        <div class="d-flex gap-3 mb-4">
                                            <!-- Inside Dhaka -->
                                            <label class="delivery-option flex-grow-1 p-3 border rounded-4 text-center cursor-pointer" 
                                                data-charge="{{ isset($product->inside_dhaka) ? $product->inside_dhaka : App\Models\Basicinfo::first()->inside_dhaka_charge }}" 
                                                onclick="selectZone(this)">
                                                <input type="radio" name="deliveryCharge" value="{{ isset($product->inside_dhaka) ? $product->inside_dhaka : App\Models\Basicinfo::first()->inside_dhaka_charge }}" checked hidden>
                                                <div class="fw-bold">Inside Dhaka</div>
                                                <div class="small">FREE · 1-2 days</div>
                                            </label>

                                            <!-- Outside Dhaka -->
                                            <label class="delivery-option flex-grow-1 p-3 border rounded-4 text-center cursor-pointer" 
                                                data-charge="{{ isset($product->outside_dhaka) ? $product->outside_dhaka : App\Models\Basicinfo::first()->outside_dhaka_charge }}" 
                                                onclick="selectZone(this)">
                                                <input type="radio" name="deliveryCharge" value="{{ isset($product->outside_dhaka) ? $product->outside_dhaka : App\Models\Basicinfo::first()->outside_dhaka_charge }}" hidden>
                                                <div class="fw-bold">Outside Dhaka</div>
                                                <div class="small">FREE · 2-3 days</div>
                                            </label>
                                        </div>
                                       
                                
                                        <div class="payment-tab">
                                            <h4 class="fw-bold mb-3">Payment</h4>
                                            <!-- Cash on Delivery -->
                                            <label class="d-flex align-items-center p-3 mb-3 border rounded-4" 
                                                style="border: 2px solid #fd7e14; background-color: #fff0e6; cursor: pointer;">
                                                <input type="radio" name="payment" checked class="me-3" style="width: 20px; height: 20px; accent-color: #fd7e14;">
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold">Cash on Delivery</div>
                                                    <div class="text-muted small">Pay when your order arrives</div>
                                                </div>
                                                <i class="fas fa-money-bill-wave text-danger"></i>
                                            </label>

                                            <!-- bKash/Nagad -->
                                            <label class="d-flex align-items-center p-3 border rounded-4 bg-light" style="opacity: 0.6; cursor: not-allowed;">
                                                <input type="radio" name="payment" disabled class="me-3" style="width: 20px; height: 20px;">
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold text-muted">
                                                        bKash / Nagad 
                                                        <span class="badge bg-secondary ms-2 small" style="font-size: 10px;">UNAVAILABLE NOW</span>
                                                    </div>
                                                    <div class="text-muted small">Online payment coming soon</div>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <span class="badge bg-secondary">bKash</span>
                                                    <span class="badge bg-secondary">Nagad</span>
                                                </div>
                                            </label>
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
                            <div class="input-group mb-3">
                                <input type="text" class="form-control rounded-start-pill border-secondary-subtle px-3" 
                                    placeholder="COUPON CODE" style="height: 50px; font-weight: 500;">
                                
                                <button class="btn btn-secondary rounded-end-pill px-4" 
                                        style="height: 50px; background-color: #888; border: none;">
                                    Apply
                                </button>
                            </div>
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
                            <hr>

                            <!-- Total -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold">Total</h4>
                                <h4 class="fw-bold text-danger">৳<span id="totalamount">0</span></h4>
                            </div>

                            <button type="submit" id="orderConfirm" class="btn btn-danger w-100 py-3 fw-bold fs-5">
                                Place Order · ৳<span id="btnTotal">0</span>
                            </button>

                            <ul class="list-unstyled mt-1">
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
        /*.spinner {*/
        /*    display: none;*/
        /*}*/
        hr {
            border: solid #ddd;
            border-width: 1px 0 0;
            clear: both;
            height: 0;
            margin: 10px 0px 10px;
        }
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

        function selectZone(element) {
            // ১. ডিজাইনের জন্য অ্যাক্টিভ ক্লাস টগল করা
            $('.delivery-option').removeClass('active').css({'background-color': '#fff', 'color': '#000'});
            $(element).addClass('active').css({'background-color': '#000', 'color': '#fff'});
            
            // ২. রেডিও বাটন সিলেক্ট করা
            $(element).find('input[type="radio"]').prop('checked', true);
            
            // ৩. চার্জ ক্যালকুলেশন
            let charge = parseFloat($(element).data('charge'));
            $('#dinamicdalivery').text(charge);
            
            // ৪. টোটাল অ্যামাউন্ট আপডেট করা (আপনার আগের সাবটোটাল ধরে)
            let subtotal = parseFloat($('#ordersubtotalprice').val()) || 0; // textarea থেকে ভ্যালু নেওয়া
            let total = subtotal + charge;
            
            $('#totalamount').text(total);
            $('#btnTotal').text(total);
        }

        // পেজ লোড হলে প্রথম অপশনটি সিলেক্টেড রাখা
        $(document).ready(function() {
            $('.delivery-option').first().trigger('click');
        });

  

        function updateQuantity(rowId) {
            var quantity = $('#QuantityPeo' + rowId).val();
            var price = $('#priceOf' + rowId).val();
            var producttotal = quantity * price;

            // ১. নির্দিষ্ট আইটেমের টোটাল আপডেট করুন
            $('#pricetotal' + rowId).html(producttotal);
            $('#minQty' + rowId).html(quantity);

            // ২. পুনরায় সাবটোটাল ক্যালকুলেট করুন (সব আইটেম যোগ করে)
            var newSubtotal = 0;
            $('.item-total').each(function() { // নিশ্চিত করুন প্রতিটি আইটেমের টোটালে 'item-total' ক্লাস আছে
                newSubtotal += parseFloat($(this).text()) || 0;
            });

            // ৩. কার্টের মোট সংখ্যা ক্যালকুলেট করুন
            var totalCartItems = 0;
            $('input[id^="QuantityPeo"]').each(function() {
                totalCartItems += parseInt($(this).val()) || 0;
            });

            // UI আপডেট
            $('#subtotalprice').html(newSubtotal);
            $('#ordersubtotalprice').html(newSubtotal);
            $('#minsubtotalprice').html(newSubtotal);
            $('#cartNumber').html(totalCartItems);

            // ৪. ডেলিভারি চার্জসহ টোটাল আপডেট
            var deliverycharge = parseFloat($('#deliveryCharge').val()) || 0;
            var totalprice = newSubtotal + deliverycharge;
            $('#totalamount').html(totalprice);

            // ৫. সার্ভারে ডাটা পাঠানো
            $.ajax({
                type: 'POST',
                url: 'update-cart',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                    qty: quantity,
                },
                success: function (data) {
                    // সার্ভার থেকে আপডেট ভ্যালু নিশ্চিত করা
                    $('#QuantityPeo' + rowId).val(data.qty);
                },
                error: function (error) {
                    console.log('Error updating cart');
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

@endsection
