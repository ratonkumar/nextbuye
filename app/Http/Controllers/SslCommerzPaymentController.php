<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderproduct;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Cart;


class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

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
                'status' => 'Payment Pending',
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
        $contect = json_decode($request['cart_json']);
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $contect->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $contect->cus_name;
        $post_data['cus_email'] = 'demo@mail.com';
        $post_data['cus_add1'] = $contect->cus_addr1;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $contect->cus_phone;
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

        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $orderID = $lastOrder->id + 1;
        } else {
            $orderID = 1;
        }

        $post_data['invoice_id'] = 'BG77'.$orderID;

        $products = Cart::content();

//            $admin = Admin::whereHas('roles', function ($q) {
//                $q->where('name', 'user');
//            })->where('status', 'Active')->inRandomOrder()->first();

            #Before  going to initiate the payment order status need to update as Pending.
            DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'invoiceID' => $post_data['invoice_id'],
                    'subTotal' => $post_data['total_amount'],
                    'status' => 'Payment Pending',
                    'transaction_id' => $post_data['tran_id'],
                    'admin_id'=>1,
                    'orderDate'=>date('Y-m-d'),
                    'deliveryCharge'=> $contect->deliveryCharge
                    
                ]);
            $order = DB::table('orders')->latest('id')->first();

//            if (isset($admin)) {
//                $order->admin_id = $admin->id;
//            } else {
//                $admin = Admin::findOrfail(1);
//                $order->admin_id = $admin->id;
//            }
//            $result = $order->save();

            // Populate customer information
            $customer = new Customer();
            $customer->customerName = $contect->cus_name;
            $customer->customerAddress = $contect->cus_addr1;
            $customer->customerPhone = $contect->cus_phone;
            $customer->order_id = $order->id;
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
        $notification->comment = $order->invoiceID.' Order Has Been Created';
        $notification->admin_id = $order->admin_id;
        $notification->save();
        


            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        
    }

    public function success(Request $request)
    {
//       dd($request->all());

       // echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
//        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
//            ->select('transaction_id', 'status', 'currency', 'amount')->first();
            ->select('transaction_id', 'status', 'subTotal')->first();


        if ($order_details->status == 'Payment Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing', 'paidAmount'=>$amount]);
//                echo "<br >Transaction is successfully Completed";

                Cart::destroy();
                toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);


            }
            return redirect('/order-received');
        } else {
            if ($order_details->status == 'Processing') {
                /*
                 That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
                 */
                Cart::destroy();
                toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);

                return redirect('/order-received');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                echo "Invalid Transaction";
            }
        }

        Cart::destroy();
        Session::put('ordersubtotal', $request->subTotal);
        Session::put('orderdeliverycharge', $request->deliveryCharge);
        Session::put('order_id', $order->id);
        toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'subTotal')->first();

        if ($order_details->status == 'Payment Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Falied";
        } else {
            if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                echo "Transaction is already Successful";
            } else {
                echo "Transaction is Invalid";
            }
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status','subTotal')->first();

        if ($order_details->status == 'Payment Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else {
            if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                echo "Transaction is already Successful";
            } else {
                echo "Transaction is Invalid";
            }
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'subTotal')->first();

            if ($order_details->status == 'Payment Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->subTotal,
                    'BDT');
                if ($validation == true) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else {
                if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                    #That means Order status already updated. No need to udate database.

                    echo "Transaction is already successfully Completed";
                } else {
                    #That means something wrong happened. You can redirect customer to your product page.

                    echo "Invalid Transaction";
                }
            }
        } else {
            echo "Invalid Data";
        }
    }

}
