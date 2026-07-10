<?php

namespace App\Helper;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz
{
    static function  InitiatePayment($customer,$total,$tran_id,$user_email)
    {
        try{
            $ssl= SslcommerzAccount::first();
            $response = Http::asForm()->post($ssl->init_url,[
                "store_id"=>$ssl->store_id,
                "store_passwd"=>$ssl->store_passwd,
                "total_amount"=>$total,
                "currency"=>$ssl->currency,
                "tran_id"=>$tran_id,
                "success_url"=>"$ssl->success_url?tran_id=$tran_id",
                "fail_url"=>"$ssl->fail_url?tran_id=$tran_id",
                "cancel_url"=>"$ssl->cancel_url?tran_id=$tran_id",
                "ipn_url"=>$ssl->ipn_url,
                "cus_name"=>$customer->customerName,
                "cus_email"=>$user_email,
                "cus_add1"=>$customer->customerAddress,
                "cus_add2"=>$customer->customerAddress,
                "cus_city"=>'Dhaka',
                "cus_state"=>'Dhaka',
                "cus_postcode"=>"1200",
                "cus_country"=>'Bangladesh',
                "cus_phone"=>$customer->customerPhone,
                "cus_fax"=>$customer->customerPhone,
                "shipping_method"=>"YES",
                "ship_name"=>$customer->customerName,
                "ship_add1"=>$customer->customerAddress,
                "ship_add2"=>$customer->customerAddress,
                "ship_city"=>'Dhaka',
                "ship_state"=>'Dhaka',
                "ship_country"=>'Bangladesh' ,
                "ship_postcode"=>"12000",
                "product_name"=>"Products",
                "product_category"=>"Category",
                "product_profile"=>"Profile",
                "product_amount"=>$total,
            ]);
            return $response->json('desc');
        }
        catch (Exception $e){
            return $e->getMessage();
        }

    }



    static function InitiateSuccess($invoiceID):int{
        Order::where(['invoiceID'=>$invoiceID])->update(['Payment'=>'Success']);
        return 1;
    }








    static function InitiateFail($invoiceID):int{
        Order::where(['$invoiceID'=>$invoiceID])->update(['Payment'=>'Fail']);
        return 1;
    }



    static function InitiateCancel($invoiceID):int{
        Invoice::where(['invoiceID'=>$invoiceID])->update(['Payment'=>'Cancel']);
        return 1;
    }

    static function InitiateIPN($invoiceID,$status):int{
        Invoice::where(['invoiceID'=>$invoiceID])->update(['Payment'=>$status]);
        return 1;
    }
}
