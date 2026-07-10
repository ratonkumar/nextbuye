<aside class="card">

    <header class="mb-4">
        <h4 class="card-title" style="font-size: 16px;">আপনার অর্ডার</h4>
    </header>
    <div class="row">
        <div class="col-md-12" >                
                <table class="table border-bottom">
                    @forelse ($cartProducts as $cartProduct)
                        <tr class="cart-item" id="productcart{{ $cartProduct->rowId }}">
                            <td class="product-image" id="proImgDiv">
                                <a href="#" class="mr-3">
                                    <img class=" ls-is-cached lazyloaded"
                                         src="{{ asset($cartProduct->image) }}" id="proImg" style="width:50px;height:50px;">
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
                                            {{ $cartProduct->price }} * {{ $cartProduct->qty }} </span>
                                    </div>
                                    <div class="qtyinfo" style="display:none">
                                        <div class="input-group input-group--style-2 pr-4"
                                             style="width: 130px;float:left">
                                            <span class="input-group-btn" style="display:none">
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
                                                   onchange="updateQuantity('{{ $cartProduct->rowId }}', this)" readonly>
                                            <span class="input-group-btn" style="display:none">
                                                <button class="btn btn-number"
                                                        onclick="updatenum('{{$cartProduct->rowId}}')"
                                                        id="äddqty" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                   
                                    </div>
                                </div>
                            </td>
                                <input type="text" name="productP" id="priceOf{{ $cartProduct->rowId }}" value="{{ $cartProduct->price }}" hidden>
                                <input type="text" name="size" value="{{ $cartProduct->options->size }}" hidden>
                                <input type="text" name="color" value="{{ $cartProduct->options->color }}" hidden>
                        </tr>
                    @empty
                    @endforelse
                </table>
            </div>
        </div>
        <!--</article>-->

    <article class="card-body border-top">
        <dl class="row">
            <dt class="col-sm-8">Subtotal:</dt>
            <dd class="col-sm-4 text-right"><strong>৳ <span
                            id="subtotalprice">{{ Cart::subtotalFloat() }}</span> </strong></dd>

            <dt class="col-sm-8">Delivery charge:</dt>
            <dd class="col-sm-4 text-danger text-right"><strong>৳
                    @php $charge = 0 ; @endphp
                    @if (isset($product->inside_dhaka))
                        @php $charge = $product->inside_dhaka ; @endphp
                        <span id="dinamicdalivery">{{ $product->inside_dhaka }}</span>
                    @else
                        @php $charge = App\Models\Basicinfo::first()->inside_dhaka_charge; @endphp
                        <span id="dinamicdalivery">{{App\Models\Basicinfo::first()->inside_dhaka_charge}}</span>
                    @endif
                </strong></dd>

            <dt class="col-sm-8">Total:</dt>
            <dd class="col-sm-4 text-right"><strong class="h5 text-dark">৳ <span
                            id="totalamount">{{Cart::subtotalFloat() + $charge }} </span></strong></dd>
        </dl>

    </article>
</aside>