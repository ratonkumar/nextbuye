<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use Session;


class CartController extends Controller
{
    public function addtocart(Request $request){ 
        
        $pid = $request->product_id;
        $cartProduct = Product::where('id',$pid)->first();
        
        if(!empty($request->weight)) {
           Cart::add([
                'id' => $request->product_id,
                'name' => $cartProduct->ProductName,
                'code' => $cartProduct->ProductSku,
                'price' =>  $request->sale_price,
                'qty' => $request->qty,
                'weight' =>1,
                'image' => $cartProduct->ProductImage,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'salePrice' => $request->sale_price,
                    'regularPrice' => $request->rg_price,
                     'get_weight' => $request->weight,
                ],
    
            ]); 
        } else {
            Cart::add([
            'id' => $request->product_id,
            'name' => $cartProduct->ProductName,
            'code' => $cartProduct->ProductSku,
            'price' => $cartProduct->ProductSalePrice,
            'qty' => $request->qty,
            'weight' =>1,
            'image' => $cartProduct->ProductImage,
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'salePrice' => $request->sale_price,
                'regularPrice' => $request->rg_price,
                 'get_weight' => $request->weight,
            ],

        ]);
            
        }
        
        return response()->json('success', 200);
        // return redirect('checkout');
        // return response()->json('success',200);
    }

    public function singleAddCart(Request $request){ 
        
        $pid = $request->productID;
        
        $type = $request->type;
        
        
        $cartProduct = Product::where('id',$pid)->first();
        Cart::destroy();
        if(!empty($request->weight)) {
           Cart::add([
                'id'      => $request->product_id,
                'name'    => $cartProduct->ProductName,
                'code'    => $cartProduct->ProductSku,
                'price'   =>  $request->sale_price,
                'qty'     => $request->qty,
                'weight'  =>1,
                'image'   => $cartProduct->ProductImage,
                'options' => [
                    'size'         => $request->size,
                    'color'        => $request->color,
                    'salePrice'    => $request->sale_price,
                    'regularPrice' => $request->rg_price,
                    'get_weight'  => $request->weight,
                ],
    
            ]); 
        } else {
            Cart::add([
            'id' => $request->productID,
            'name' => $cartProduct->ProductName,
            'code' => $cartProduct->ProductSku,
            'price' => $cartProduct->ProductSalePrice,
            'qty' =>  $request->qty,
            'weight' =>1,
            'image' => $cartProduct->ProductImage,
            'options' => [
                'size' => '',
                'color' =>'',
                'salePrice' => $cartProduct->ProductSalePrice,
                'regularPrice' => $cartProduct->ProductSalePrice,
                 'get_weight' => 0,
            ],

        ]);
            
        }
        $cartProducts = Cart::content();
        
        if($type == 2) {
            return $cartProduct->ProductSalePrice* $request->qty;
        }
        return view('webview.content.product.list_single_product')->with('cartProducts', $cartProducts);
        return redirect('checkout');
        // return response()->json('success',200);
    }


    public function updatecart(Request $request){
        $rowId = $request->rowId;
        Cart::update($rowId, $request->qty);

        $quentity = [
            'qty' => $request->qty,
        ];
        return response()->json($quentity , 200);
    }

    public function destroy(Request $request){
        Cart::remove($request->rowId);
        $olditem = count(Cart::content());
        if($olditem == '0'){
            Cart::destroy();
            return response()->json('empty',200);
        }
        $cartProducts = Cart::content();
        return view('webview.content.product.cartproductmodal')->with('cartProducts', $cartProducts);

    }

    public function getcartcontent(){
        $cartProducts = Cart::content();
        return view('webview.content.product.cartproductmodal')->with('cartProducts', $cartProducts);
    }

    public function getcheckcartcontent(){
        $cartProducts = Cart::content();
        return view('webview.content.product.checkcartview')->with('cartProducts', $cartProducts);
    }

    public function cartcontent(){
        $cartProducts = Cart::content();
        $num=count($cartProducts);
        $am=Cart::subtotal();
        $arr=['item'=>$num,'amount'=>$am];
        return response()->json($arr, 200);
    }

    public function cart(){
        return view('webview.content.cart.cart');
    }

    public function loadcart(){
        $cartProducts = Cart::content();
        return view('webview.content.cart.summery')->with('cartProducts', $cartProducts);
    }

    public function checkout(){
        $cartProducts = Cart::content();
        return view('webview.content.cart.checkout')->with('cartProducts', $cartProducts);
    }
     public function payment(){
        $cartProducts = Cart::content();
        return view('webview.content.cart.payment')->with('cartProducts', $cartProducts);
    }

    public function complete(){
        $id=Session::get('order_id');
        $order =  Order::with([
                        'orderproducts'=>function ($query) { $query->select('id','order_id','productName','quantity','productPrice');},
                        'admins'=> function ($query) { $query->select('id','name');},
                    ])->join('customers', 'customers.order_id', '=', 'orders.id')
                    ->select('orders.*', 'customers.order_id','customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
                    ->where('orders.id', $id)
                    ->first();
        return view('webview.content.cart.complete',['order'=>$order]);
    }



}