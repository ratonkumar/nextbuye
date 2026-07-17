@extends('webview.master')

@section('maincontent')
@section('title', env('APP_NAME') . '-Checkout')

<div class="container py-5">
    @if (!Session::has('cart') || Cart::count() == 0)
        <div class="card shadow-sm text-center p-5">
            <h2 class="h4">কোন প্রোডাক্ট নেই</h2>
            <a class="btn btn-primary mt-3" href="{{ url('/') }}">প্রোডাক্ট বাছাই করুন</a>
        </div>
    @else
        <form action="{{ url('press/order') }}" method="POST" id="orderForm">
            @csrf
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-7">
                    <h4 class="mb-3">Delivery details</h4>
                    <div class="card shadow-sm p-4 mb-4">
                        <div class="mb-3">
                            <label class="form-label">Full name *</label>
                            <input type="text" name="customerName" class="form-control" placeholder="আপনার নাম" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone number *</label>
                            <input type="text" name="customerPhone" class="form-control" placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full address *</label>
                            <textarea name="customerAddress" class="form-control" rows="2" placeholder="আপনার ঠিকানা" required></textarea>
                        </div>
                        
                        <label class="form-label">Delivery zone</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="deliveryCharge" id="inDhaka" value="{{ $product->inside_dhaka ?? App\Models\Basicinfo::first()->inside_dhaka_charge }}" checked onchange="updateTotal()">
                                <label class="btn btn-outline-secondary w-100 p-3 text-start" for="inDhaka">
                                    <strong>Inside Dhaka</strong><br>৳{{ $product->inside_dhaka ?? App\Models\Basicinfo::first()->inside_dhaka_charge }}
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="deliveryCharge" id="outDhaka" value="{{ $product->outside_dhaka ?? App\Models\Basicinfo::first()->outside_dhaka_charge }}" onchange="updateTotal()">
                                <label class="btn btn-outline-secondary w-100 p-3 text-start" for="outDhaka">
                                    <strong>Outside Dhaka</strong><br>৳{{ $product->outside_dhaka ?? App\Models\Basicinfo::first()->outside_dhaka_charge }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="col-lg-5">
                    <div class="card shadow-sm p-4 sticky-top">
                        <h4 class="mb-3">Your order</h4>
                        @foreach ($cartProducts as $cartProduct)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset($cartProduct->image) }}" class="rounded" style="width: 60px;">
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-bold">{{ $cartProduct->name }}</div>
                                    <div class="d-flex align-items-center mt-1">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty('{{$cartProduct->rowId}}', -1)">-</button>
                                        <span class="mx-2 px-2">{{ $cartProduct->qty }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty('{{$cartProduct->rowId}}', 1)">+</button>
                                    </div>
                                </div>
                                <div class="fw-bold">৳{{ $cartProduct->qty * $cartProduct->price }}</div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between"><span>Subtotal</span> <strong>৳<span id="subtotal">{{ Cart::subtotalFloat() }}</span></strong></div>
                        <div class="d-flex justify-content-between"><span>Delivery</span> <strong>৳<span id="deliveryDisplay">0</span></strong></div>
                        <hr>
                        <div class="d-flex justify-content-between h4"><span>Total</span> <strong class="text-primary">৳<span id="grandTotal">0</span></strong></div>
                        
                        <button type="submit" class="btn btn-lg btn-danger w-100 mt-3 p-3">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

<!-- Scripts Section -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // ক্যালকুলেশন লজিক
    function updateTotal() {
        let subtotal = parseFloat($('#subtotal').text());
        let delivery = parseFloat($('input[name="deliveryCharge"]:checked').val());
        let total = subtotal + delivery;
        
        $('#deliveryDisplay').text(delivery);
        $('#grandTotal').text(total);
    }

    // পেজ লোড হলে ক্যালকুলেট করবে
    $(document).ready(function() {
        updateTotal();
    });

    // কোয়ান্টিটি আপডেট ফাংশন
    function updateQty(rowId, change) {
        // এখানে আপনার Ajax রিকোয়েস্ট বসাবেন যা সার্ভারে qty আপডেট করবে
        // আপডেট শেষে পেজ রিফ্রেশ বা কন্টেন্ট রিফ্রেশ করবেন
        alert("Quantity update logic for: " + rowId);
    }
</script>
@endsection