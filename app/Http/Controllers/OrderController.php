<?php

namespace App\Http\Controllers;

use App\Helper\SSLCommerz;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Orderproduct;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Basicinfo;
use DB;
use App\Models\Admin;
use Cart;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Library\SslCommerz\SslCommerzNotification;
// use GeoIP;
use Jenssegers\Agent\Agent;
use GeoIp2\Database\Reader;
use GeoIP;


class OrderController extends Controller
{

    public function pressorder(Request $request)
    {
//         $location = GeoIP::getLocation();
// dd($location);
        $products = Cart::content();

        if (!Session::has('cart')) {
            return redirect('/empty-cart');
        } elseif (Cart::count() == 0) {
            return redirect('/empty-cart');
        } else {
            
             $totalUser = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('status', 'Active')
          
            ->inRandomOrder()
            ->count();
            
            $latestOrder = Order::latest()->first();
            
            $admin = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('status', 'Active');
            
            if($totalUser > 1) {
                $admin = $admin->where('id','!=',$latestOrder->admin_id);
            }
            
            
             $admin = $admin->inRandomOrder()
            ->first();
            
            $dateFrom   = date('Y-m-d');
            $dateTo     = date('Y-m-d');
            $startDate  = Carbon::createFromFormat('Y-m-d',  $dateFrom )->startOfDay();
            $endDate    = Carbon::createFromFormat('Y-m-d', $dateTo)->endOfDay();;
            
            $isBlacklisted = DB::table('blocklist')
                ->where('ip_address', request()->ip())
                // ->orWhere('phone', $request->customerPhone)
                ->where('status', 1)
                ->whereBetween('created_at',[$startDate, $endDate])
                ->count();
        
        
            $isBlacklistedPhone = DB::table('blocklist')
                ->where('phone', $request->customerPhone)
                // ->orWhere('phone', $request->customerPhone)
                ->where('status', 1)
                ->whereBetween('created_at',[$startDate, $endDate])
                ->count();
                
                
            if ($isBlacklisted > 0 || $isBlacklistedPhone > 0) {
            // Reject order

                $response['status'] = 'ip_block';
                // $response['link'] = url('/');
                $response['message'] = 'Unsuccessful to Placed Order';
               
                return response()->json($response, 201); 
                
            }
            
             $isBlacklistedP = DB::table('blocklist')
                ->where('ip_address', request()->ip())
                // ->orWhere('phone', $request->customerPhone)
                ->where('status', 2)
                // ->whereBetween('created_at',[$startDate, $endDate])
                ->count();
                
                
            $isBlacklistedPhones = DB::table('blocklist')
                // ->where('ip_address', request()->ip())
                ->where('phone', $request->customerPhone)
                ->where('status', 2)
                // ->whereBetween('created_at',[$startDate, $endDate])
                ->count();
        
            if ($isBlacklistedP > 0 || $isBlacklistedPhones > 0 ) {
            // Reject order

                $response['status'] = 'ip_block';
                // $response['link'] = url('/');
                $response['message'] = 'Unsuccessful to Placed Order';
               
                return response()->json($response, 201); 
                
            }
            
            
            
            $agent = new Agent();
            $is_device  = '';
            if($agent->isDesktop()) {
                $is_device  = 'Desktop';
            }
            if($agent->isPhone()) {
                $is_device  = 'Phone';
            }
            if($agent->isPhone()) {
                $is_device  = 'Phone';
            }
            
            $reader = new Reader(storage_path('app/geoip/GeoLite2-City.mmdb'));
            $record = $reader->city(request()->ip()); // Example IP
            
          
        
           DB::table('blocklist')->insert(
                [
                    'ip_address' => request()->ip(), 
                    'phone' => $request->customerPhone,
                    'device_info' => $is_device,
                     'browser_fingerprint' => $agent->browser(),
                    'city' => $record->city->name,
                    'status' =>0,
                ]
            );
            $order = new Order();
            $order->user_id        = $request->user_id;
            $order->store_id       = 1;
            $order->invoiceID      = $this->uniqueID();
            $order->subTotal       = $request->subTotal ?? 0;
            $order->deliveryCharge = $request->deliveryCharge ?? 0;
            $order->orderDate      = date('Y-m-d');
            $order->customerNote   = $request->customerNotes;
            if (isset($admin)) {
                $order->admin_id = $admin->id;
            } else {
                $admin = Admin::findOrfail(1);
                $order->admin_id = $admin->id;
            }
            $result = $order->save();
            $total = (float)($request->subTotal ?? 0) + (float)($request->deliveryCharge ?? 0);
            if ($result) {
              
                    $customer = new Customer();
                    $customer->order_id = $order->id;
                    $customer->customerName = $request->customerName;
                    $customer->customerPhone = $request->customerPhone;
                    $customer->customerAddress = $request->customerAddress;
         
                    $customer->save();
                    foreach ($products as $product) {
                        $orderProducts = new Orderproduct();
                        $orderProducts->order_id = $order->id;
                        $orderProducts->product_id = $product->id;
                        $orderProducts->productCode = $product->code;
                        if ($product->options['color'] == 'undefined') {
                        } else {
                            $orderProducts->color = $product->options['color'];
                        }

                        if ($product->options['size'] == 'undefined') {
                        } else {
                            $orderProducts->size = $product->options['size'];
                        }
                        $orderProducts->weight       = $product->options['get_weight'] ?? '';
                        $orderProducts->productName = $product->name;
                        $orderProducts->quantity = $product->qty;
                        $orderProducts->productPrice = $product->price;
                        $orderProducts->save();
                    }

                  


                    $notification = new Comment();
                    $notification->order_id = $order->id;
                    $notification->comment = $order->invoiceID.' Order Has Been Created for '.$admin->name;
                    $notification->admin_id = $order->admin_id;
                    $notification->save();
                    Cart::destroy();
                    Session::put('ordersubtotal', $request->subTotal);
                    Session::put('orderdeliverycharge', $request->deliveryCharge);
                    Session::put('order_id', $order->id);
                    toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);


                    
                    return redirect('order-received');
                
                   
                }
             else {
                Customer::where('order_id', '=', $order->id)->delete();
                Orderproduct::where('order_id', '=', $order->id)->delete();
                Comment::where('order_id', '=', $order->id)->delete();
                Order::where('id', '=', $order->id)->delete();
                $response['status'] = 'failed';
                $response['message'] = 'Unsuccessful to press order';
            }
        }
    }


    public function onlineOrder(Request  $request)
    {
        $products = Cart::content();

        if (!Session::has('cart')) {
            return redirect('/empty-cart');
        } elseif (Cart::count() == 0) {
            return redirect('/empty-cart');
        } else {
            $admin = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('status', 'Active')->inRandomOrder()->first();

            $order = new Order();
            $order->user_id = $request->user_id;
            $order->store_id = 1;
            $order->invoiceID = $this->uniqueID();
            $order->subTotal = $request->subTotal;
            $order->deliveryCharge = $request->deliveryCharge;
            $order->orderDate = date('Y-m-d');
            $order->customerNote = '';
            if (isset($admin)) {
                $order->admin_id = $admin->id;
            } else {
                $admin = Admin::findOrfail(1);
                $order->admin_id = $admin->id;
            }
            $result = $order->save();
            $total=$request->subTotal+$request->deliveryCharge;
            if ($result) {

                $customer = new Customer();
                $customer->order_id = $order->id;
                $customer->customerName = $request->customerName;
                $customer->customerPhone = $request->customerPhone;
                $customer->customerAddress = $request->customerAddress;
                $customer->save();
                foreach ($products as $product) {
                    $orderProducts = new Orderproduct();
                    $orderProducts->order_id = $order->id;
                    $orderProducts->product_id = $product->id;
                    $orderProducts->productCode = $product->code;
                    if ($product->options['color'] == 'undefined') {
                    } else {
                        $orderProducts->color = $product->options['color'];
                    }

                    if ($product->options['size'] == 'undefined') {
                    } else {
                        $orderProducts->size = $product->options['size'];
                    }

                    $orderProducts->productName = $product->name;
                    $orderProducts->quantity = $product->qty;
                    $orderProducts->productPrice = $product->price;
                    $orderProducts->save();
                }




                $notification = new Comment();
                $notification->order_id = $order->id;
                $notification->comment = $order->invoiceID.' Order Has Been Created for '.$admin->name;
                $notification->admin_id = $order->admin_id;
                $notification->save();
                Cart::destroy();
                Session::put('ordersubtotal', $request->subTotal);
                Session::put('orderdeliverycharge', $request->deliveryCharge);
                Session::put('order_id', $order->id);
                toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);


                $paymentMethod=  SSLCommerz::InitiatePayment($customer, $total, $order->invoiceID, 'user@gmail.com');
                return response()->json(['status' => 'success','paymentMethod' => $paymentMethod, 'payable' => $total]);


            }
            else {
                Customer::where('order_id', '=', $order->id)->delete();
                Orderproduct::where('order_id', '=', $order->id)->delete();
                Comment::where('order_id', '=', $order->id)->delete();
                Order::where('id', '=', $order->id)->delete();
                $response['status'] = 'failed';
                $response['message'] = 'Unsuccessful to press order';
            }
        }
    }


    public function uniqueID()
    {
        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $orderID = $lastOrder->id + 1;
        } else {
            $orderID = 1;
        }
        
        $inv_slug = Basicinfo::first()->inv_slug;

        return $inv_slug.$orderID;
    }

    public function updatepaymentmethood(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->Payment = $request->payment_option;
        $order->update();
        Session::put('successfulor', 'successfulor');
        return redirect('order/complete');
    }

    public function getorder()
    {
        $from = date('Y-m-d'.' 00:00:00', time()); //need a space after dates.
        $to = date('Y-m-d'.' 24:60:60', time());


        $now = Carbon::now();
        $yesterday = Carbon::now()->subDays(5);
        $orders = DB::table('orders')->orderBy('id', 'DESC')->whereBetween('created_at',
            [$yesterday, $now])->take(200)->get();

        $orders->map(function ($order) {
            $order->products = DB::table('orderproducts')
                ->leftjoin('products', 'orderproducts.product_id', '=', 'products.id')
                ->where('orderproducts.order_id', $order->id)->select('products.*', 'orderproducts.*')->get();
            return $order;
        });

        $orders->map(function ($order) {
            $order->customers = DB::table('customers')->where('customers.order_id', $order->id)->select('customers.id',
                'customers.order_id', 'customers.customerName', 'customers.customerPhone',
                'customers.customerAddress')->get();
            return $order;
        });

        return response()->json($orders, 201);
    }

    public function getproduct()
    {
        $products = Product::select('id', 'ProductName', 'ProductSlug', 'ProductSku', 'ProductRegularPrice',
            'ProductSalePrice', 'ProductImage', 'ViewProductImage', 'status')->where('status', 'Active')->get();
        $response = [
            'status' => 's',
            'products' => $products,
        ];
        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    
    
    
//    testing purpach here

    public function index(Request $request)
    {
        
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
//        $update_product = DB::table('orders')
//            ->where('transaction_id', $post_data['tran_id'])
//            ->updateOrInsert([
//                'name' => $post_data['cus_name'],
//                'email' => $post_data['cus_email'],
//                'phone' => $post_data['cus_phone'],
//                'amount' => $post_data['total_amount'],
//                'status' => 'Pending',
//                'address' => $post_data['cus_add1'],
//                'transaction_id' => $post_data['tran_id'],
//                'currency' => $post_data['currency']
//            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

}