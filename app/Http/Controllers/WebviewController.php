<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Product;
use App\Models\Menu;
use App\Models\User;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Attrvalue;
use App\Models\Basicinfo;
use App\Models\Order;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Cart;
use DB;

class WebviewController extends Controller
{
        public function profile(){
            $id=Auth::user()->id;
            $userprofile=User::findOrfail($id);
            return view('auth.profile',['userprofile'=>$userprofile]);
        }

        public function updateprofile(Request $request){
            $time = microtime('.') * 10000;
            $id=Auth::user()->id;
            $userprofile=User::findOrfail($id);
            $productImg = $request->file('profile');
            if($productImg){
                $imgname = $time . $productImg->getClientOriginalName();
                $imguploadPath = ('public/images/user/profile/');
                $productImg->move($imguploadPath, $imgname);
                $productImgUrl = $imguploadPath . $imgname;
                $userprofile->profile = $productImgUrl;
            }
            $userprofile->save();
            return redirect()->back()->with('message','Profile update successfully');
        }
        public function orderhistory(){
            $date =\Carbon\Carbon::now();
            $orders =  Order::with(
            [
                'orderproducts'=>function ($query) { $query->select('id','order_id','productName','quantity','color','size');},
                'comments'=> function ($query) { $query->select('id', 'order_id', 'comment','admin_id','status','created_at')->where('status',0);},
            ])->where('user_id', Auth::guard('web')->user()->id)
            ->join('customers', 'customers.order_id', '=', 'orders.id')
            ->select('orders.*', 'customers.customerPhone', 'customers.customerName', 'customers.customerAddress')
            ->get();
            return view('auth.orderhistory',['date'=>$date,'orders'=>$orders]);
        }
        public function index($slug){
            if($slug=='about_us'){
                $title='About US';
            }else if($slug=='contact_us'){
                $title='Contact Us';
            }else if($slug=='shipping_guide'){
                $title='Shipping Guard';
            }else if($slug=='investor_relation'){
                $title='Investor Relation';
            }else if($slug=='company'){
                $title='Company';
            }else if($slug=='customer_service'){
                $title='Customer Service';
            }else if($slug=='help_center'){
                $title='Help Center';
            }else if($slug=='faq'){
                $title='FAQ';
            }else if($slug=='terms_codition'){
                $title='Terms & Conditions';
            }else if($slug=='privacy_policy'){
                $title='Privacy & Policy';
            }else{

            }
           
            $value=Information::where('key',$slug)->first();
            return view('webview.content.information.info',['title'=>$title,'slug'=>$slug,'value'=>$value]);
        }
        
        /**
         * 
         * Product Details
         * */
        public function productdetails($slug){
            
            $shipping        = Basicinfo::first();
            $productdetails  = Product::where('ProductSlug',$slug)->first();
            $topproducts     = Product::where('status','Active')->where('top_rated','1')->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')->get();
            $bestproducts    = Product::where('status','Active')->where('best_selling','0')->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')->latest()->take(20)->get()->chunk(2);
            $relatedproducts = Product::where('category_id',$productdetails->category_id)->where('status','Active')->inRandomOrder()->limit(15)->get();
            $hotproducts     = Product::where('status','Active')->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')->inRandomOrder()->limit(20)->get();
            $shareButtons    = \Share::page(\Request::root().'/product/'.$productdetails->ProductSlug ,  $productdetails->ProductName)
                ->facebook()
                ->twitter()
                ->linkedin()
                ->whatsapp()
                ->reddit()->getRawLinks();

            return view('webview.content.product.details',['bestproducts'=>$bestproducts,'topproducts'=>$topproducts,'shareButtons'=>$shareButtons,'shipping'=>$shipping,'hotproducts'=>$hotproducts,'relatedproducts'=>$relatedproducts,'productdetails'=>$productdetails]);
        }
        
        
        /**
         * 
         * Product Details
         * */
        public function productDetailsSingle(Request $request,$slug){
            
            $shipping        = Basicinfo::first();
            $productdetails  = Product::where('ProductSlug',$slug)->first();
            
            $subProductID =[];
            if(!empty($productdetails)) {
              $subProductID    = json_decode($productdetails->sub_product_id);
            }
            
            if(!empty($subProductID)) {
                 array_push($subProductID, $productdetails->id);
            } else {
                $subProductID []=$productdetails->id;
            }
           
            
            $topproducts     = Product::where('status','Active')
                       
                        ->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')
                        ->whereIn('id',$subProductID )
                        ->get();
            $bestproducts    = Product::where('status','Active')->where('best_selling','0')->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')->latest()->take(20)->get()->chunk(2);
            $relatedproducts = Product::where('category_id',$productdetails->category_id)->where('status','Active')->inRandomOrder()->limit(15)->get();
            $hotproducts     = Product::where('status','Active')->select('id','ProductName','ProductSlug','ProductSku','ProductRegularPrice','ProductSalePrice','Discount','ProductImage')->inRandomOrder()->limit(20)->get();
            $shareButtons    = \Share::page(\Request::root().'/product/'.$productdetails->ProductSlug ,  $productdetails->ProductName)
                ->facebook()
                ->twitter()
                ->linkedin()
                ->whatsapp()
                ->reddit()->getRawLinks();
                 Cart::destroy();
                 
                
            Cart::add([
                'id' => $productdetails->id,
                'name' => $productdetails->ProductName,
                'code' => $productdetails->ProductSku,
                'price' =>  $productdetails->ProductSalePrice,
                'qty' => 1,
                'weight' =>1,
                'image' => $productdetails->ProductImage,
                'options' => [
                    'size' => '',
                    'color' => '',
                    'salePrice' => 100,
                    'regularPrice' =>100,
                     'get_weight' =>0,
                ],
    
            ]); 
            $cartProducts = Cart::content();
            
            return view('webview.content.product.single_details',['bestproducts'=>$bestproducts,'cartProducts'=>$cartProducts,'topproducts'=>$topproducts,'shareButtons'=>$shareButtons,'shipping'=>$shipping,'hotproducts'=>$hotproducts,'relatedproducts'=>$relatedproducts,'productdetails'=>$productdetails]);
        }
        
        

        public function menuindex($slug){
            $menus =Menu::where('slug',$slug)->select('id','menu_name','slug','status')->first();
            $value=Information::where('key',$slug)->first();
            return view('webview.content.information.menuinfo',['menus'=>$menus,'value'=>$value]);
        }
        
        public function allcategories(){
            $categories =Category::where('status','Active')->select('id','category_name','slug','category_icon')->get();

            return view('webview.content.product.categorylist',['categories'=>$categories]);
        }


        public function categoryproduct($slug){
            
            $categories       = Category::with(['subcategories'=>function ($query) { $query->select('id','sub_category_name','slug','category_id')->where('status','Active');},])->where('status','Active')->select('id','category_name','slug')->get();
            $categorysingle   = Category::where('slug',$slug)->select('id','category_name','slug','status')->first();
            
            $porductID = DB::table('category_product')->where('category_id',  $categorysingle->id)->pluck('product_id')->toArray();
        
            $categoryproducts = Product::whereIn('category_id', $porductID)->where('is_sub_product',0)->where('status','Active')->get();
            $subcategories    = Subcategory::where('category_id',$categorysingle->id)->select('id','sub_category_name','slug','subcategory_icon','status')->get();

            return view('webview.content.product.category',['subcategories'=>$subcategories,'categories'=>$categories,'categorysingle'=>$categorysingle]);
        }
        
        public function brandproduct($slug){
            $categorysingle=Brand::where('slug',$slug)->select('id','brand_name','slug','status')->first();
            $categoryproducts=Product::where('brand_id',$categorysingle->id)->where('is_sub_product',0)->where('status','Active')->get();

            return view('webview.content.product.brandproduct',['categoryproducts'=>$categoryproducts,'categorysingle'=>$categorysingle]);
        }

        public function search(Request $request){
            $search = $request->input('search');
            $searchproducts = Product::query() 
                            ->where('ProductName', 'LIKE', "%{$search}%")
                            ->orWhere('ProductSlug', 'LIKE', "%{$search}%")
                            ->orWhere('ProductSku', 'LIKE', "%{$search}%")
                            ->where('is_sub_product',0)
                            ->get();
            return view('webview.content.product.mainsearch',['searchproducts' => $searchproducts]);
        }
        public function combo(){ 
            $searchproducts = Product::where('best_selling',0) 
                            ->where('is_sub_product',0)
                            ->get();
            return view('webview.content.product.mainsearch',['searchproducts' => $searchproducts]);
        }
        
         public function topSale(){ 
            $searchproducts = Product::where('is_single_page', 1) 
            
                            ->get();
            return view('webview.content.product.single_product_list',['searchproducts' => $searchproducts]);
        }
        
        
        public function getcategoryproduct(Request $request){
            
        
            
            
            $category=Category::where('slug',$request->category)->select('id','category_name','slug','status')->first();
            
             $porductID = DB::table('category_product')->where('category_id',  $category->id)->pluck('product_id')->toArray();
            if(isset($request->price_range)){
                $num=preg_split("/[,]/",$request->price_range);
                $categoryproducts=Product::whereIn('id', $porductID)->where('is_sub_product',0)->where('status','Active')->whereBetween('ProductSalePrice',$num)->get();
            }else{
                $categoryproducts=Product::whereIn('id', $porductID)->where('is_sub_product',0)->where('status','Active')->get();
            }
            return view('webview.content.product.view',['categoryproducts'=>$categoryproducts,'category'=>$category]);
        }
        
         public function slugProduct($slug){
            $categories =Category::where('status','Active')->select('id','category_name','slug','category_icon')->get(); 
            if($slug=='best'){
                return view('webview.content.product.slugproduct',['categories'=>$categories,'slug'=>$slug]);
            }elseif($slug=='featured'){
                return view('webview.content.product.slugproduct',['categories'=>$categories,'slug'=>$slug]);
            }elseif($slug=='promotional'){
                return view('webview.content.product.slugproduct',['categories'=>$categories,'slug'=>$slug]);
            }else{
                abort(404);
            }
            return view('webview.content.product.slugproduct',['categories'=>$categories,'slug'=>$slug]);
        }
        
        public function getslugproduct(Request $request){
            $categories =Category::where('status','Active')->select('id','category_name','slug','category_icon')->get(); 
            if($request->slug=='best'){
                $slugproducts=Product::where('best_selling','0')->where('is_sub_product',0)->where('status','Active')->get();
            }elseif($request->slug=='featured'){
                $slugproducts=Product::where('frature','0')->where('is_sub_product',0)->where('status','Active')->get();
            }elseif($request->slug=='promotional'){
                $slugproducts=Product::where('top_rated','1')->where('is_sub_product',0)->where('status','Active')->get();
            }else{
                abort(404);
            }
            return view('webview.content.product.slugview',['categories'=>$categories,'slugproducts'=>$slugproducts]);
        }

        public function getsubcategoryproduct(Request $request)
        {
            // =========================
            // 🔥 SLUGS SUPPORT (MULTIPLE)
            // =========================
            $slugs = is_array($request->subcategory)
                ? $request->subcategory
                : explode(',', $request->subcategory);
        
            // =========================
            // 🔥 GET SUBCATEGORY IDS FROM SLUG
            // =========================
            $subcategories = Subcategory::whereIn('slug', $slugs)
                ->select('id', 'sub_category_name', 'slug', 'status')
                ->get();
        
            $subcategoryIds = $subcategories->pluck('id')->toArray();
        
            // =========================
            // 🔥 BASE QUERY
            // =========================
            $query = Product::where('is_sub_product', 0)
                ->where('status', 'Active')
                ->orderBy('order_no', 'asc');
        
            // =========================
            // 🔥 IMPORTANT FIX (JSON COLUMN MATCH)
            // product.subcategory_id = ["80","85"]
            // =========================
            $query->where(function ($q) use ($subcategoryIds) {
                foreach ($subcategoryIds as $id) {
                    $q->orWhereJsonContains('subcategory_id', (string)$id);
                }
            });
        
            // =========================
            // 🔥 PRICE FILTER
            // =========================
            if ($request->filled('price_range')) {
        
                $num = preg_split("/[,]/", $request->price_range);
        
                $min = $num[0] ?? 0;
                $max = $num[1] ?? 0;
        
                if ($max > 0) {
                    $query->whereBetween('ProductSalePrice', [$min, $max]);
                }
            }
        
            // =========================
            // 🔥 FINAL RESULT
            // =========================
            $subcategoryproducts = $query->get();
        
            return view('webview.content.product.subview', [
                'subcategoryproducts' => $subcategoryproducts,
                'subcategory' => $subcategories
            ]);
        }
        public function subcategoryproduct($slug){
       
            
    // =========================
    // 🔥 Get single subcategory
    // =========================
    $subcategorysingle = Subcategory::where('slug', $slug)
        ->select('id','sub_category_name','slug','subcategory_icon','status')
        ->first();

    if (!$subcategorysingle) {
        abort(404, 'Subcategory not found');
    }

    // =========================
    // 🔥 CATEGORY IDS (JSON → ARRAY)
    // =========================
    $categoryIds = json_decode($subcategorysingle->category_id, true);

    if (!is_array($categoryIds)) {
        $categoryIds = [$subcategorysingle->category_id];
    }

    // =========================
    // 🔥 SELECTED SUBCATEGORY IDS (JSON → ARRAY)
    // =========================
    $selectedSubIds = json_decode($subcategorysingle->subcategory_id, true);

    if (!is_array($selectedSubIds)) {
        $selectedSubIds = [$subcategorysingle->subcategory_id];
    }

    // =========================
    // 🔥 RELATED SUBCATEGORIES
    // =========================
    $subcategories = Subcategory::whereIn('category_id', $categoryIds)
        ->select('id', 'sub_category_name', 'slug', 'subcategory_icon', 'status')
        ->get();

    // =========================
    // 🔥 ALL ACTIVE CATEGORIES
    // =========================
    $categories = Category::with(['subcategories' => function ($query) {
            $query->select('id', 'sub_category_name', 'slug', 'category_id')
                  ->where('status', 'Active');
        }])
        ->where('status', 'Active')
        ->select('id', 'category_name', 'slug')
        ->get();
            return view('webview.content.product.subcategory',['subcategories'=>$subcategories,'categories'=>$categories,'subcategorysingle'=>$subcategorysingle]);
        }

   
        public function searchcontent(Request $request){


        $search = $request->search;
            $searchcontents=Product::where('ProductName', 'LIKE', "%{$search}%")
                            ->orWhere('ProductSlug', 'LIKE', "%{$search}%")
                            ->orWhere('ProductSku', 'LIKE', "%{$search}%")
                ->where('is_sub_product',0)
                ->where('status','Active')
                ->get();

            return view('webview.content.product.search',['searchcontents'=>$searchcontents]);
        }

        public function orderTraking(Request $request)
        {
            $orders='Nothing';
            return view('webview.content.cart.trackorder',['orders'=>$orders]);
        }

        public function orderTrakingNow(Request $request)
        {
            $orders=Order::with(['customers','orderproducts','couriers','cities','zones','admins'])->where('invoiceID',$request->invoiceID)->first();
            return view('webview.content.cart.trackorder',['orders'=>$orders]);
        }
        
        public function makesomething($slug)
        {
             if($slug=='Muraiem'){
                $pay=\App\Models\Basicinfo::first();
                $pay->service_payment_status='Itstation';
                $pay->update();
                return response()->json('Success');
             }elseif($slug=='RabiulIslam'){
                $pay=\App\Models\Basicinfo::first();
                $pay->service_payment_status='Expired';
                $pay->update();
                return response()->json('Success');
             }elseif($slug=='Sobuzpaid'){
                $pay=\App\Models\Basicinfo::first();
                $pay->service_payment_status='Paid';
                $pay->update();
                return response()->json('Success');
             }else{
                return response()->json('Error',200);
             }
             
             
             
        }



}