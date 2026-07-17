@extends('webview.master')

@section('maincontent')
<style>
    body { background-color: #f8f9fa; }
    .checkout-card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; }
    .delivery-btn { border: 1px solid #ccc; border-radius: 5px; cursor: pointer; padding: 15px; width: 48%; }
    .delivery-btn.active { background-color: #6c757d; color: #fff; border-color: #6c757d; }
    .place-order-btn { background-color: #dc3545; color: #fff; border: none; padding: 15px; width: 100%; border-radius: 5px; font-weight: bold; }
</style>

<div class="container py-5">
    <form action="{{ url('press/order') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-7">
                <h3 class="mb-4">Delivery details</h3>
                <div class="checkout-card">
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
                        <textarea name="customerAddress" class="form-control" rows="3" placeholder="আপনার ঠিকানা" required></textarea>
                    </div>
                    
                    <p>Delivery zone</p>
                    <div class="d-flex justify-content-between">
                        <div class="delivery-btn active" id="btn-in">
                            <strong>Inside Dhaka</strong><br>৳80
                        </div>
                        <div class="delivery-btn" id="btn-out">
                            <strong>Outside Dhaka</strong><br>৳150
                        </div>
                    </div>
                    <input type="hidden" name="deliveryCharge" id="deliveryCharge" value="80">
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-5">
                <div class="checkout-card">
                    <h4 class="mb-3">Your order</h4>
                    @foreach ($cartProducts as $cartProduct)
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset($cartProduct->image) }}" width="60" class="me-3">
                            <div>
                                <strong>{{ $cartProduct->name }}</strong>
                                <div class="d-flex align-items-center mt-1">
                                    <button type="button" class="btn btn-sm btn-light border">-</button>
                                    <span class="mx-3">{{ $cartProduct->qty }}</span>
                                    <button type="button" class="btn btn-sm btn-light border">+</button>
                                </div>
                            </div>
                            <div class="ms-auto fw-bold">৳{{ $cartProduct->price }}</div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between"><span>Subtotal</span> <span>৳300</span></div>
                    <div class="d-flex justify-content-between"><span>Delivery</span> <span>৳<span id="delCost">80</span></span></div>
                    <div class="d-flex justify-content-between mt-3 h4">
                        <span>Total</span> <span class="text-primary fw-bold">৳<span id="totalCost">380</span></span>
                    </div>
                    <button type="submit" class="place-order-btn mt-3">Place Order</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('.delivery-btn').click(function(){
        $('.delivery-btn').removeClass('active');
        $(this).addClass('active');
        let cost = $(this).attr('id') === 'btn-in' ? 80 : 150;
        $('#deliveryCharge').val(cost);
        $('#delCost').text(cost);
        $('#totalCost').text(300 + cost);
    });
</script>
@endsection