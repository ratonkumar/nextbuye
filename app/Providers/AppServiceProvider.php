<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Basicinfo;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Policymenu;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Addbanner;
use App\Models\Servicepackage;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Rakibhstu\Banglanumber\NumberToBangla;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // গ্লোবাল নাম্বার কনভার্টার ভিউতে শেয়ারিং
        view()->composer('*', function($view) {
            $view->with('numto', new NumberToBangla());
        });

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard Content
        |--------------------------------------------------------------------------
        */
        view()->composer('admin.content.adminmaincontent', function ($view) {
            $statuses = [
                'Pending Invoiced', 'Invoiced', 'Stock Out', 'Customer Confirm',
                'Request to Return', 'Paid', 'Return', 'Lost', 'Completed',
                'Delivered', 'Customer On Hold'
            ];

            $comments = Cache::remember('dashboard_comments', 600, function () {
                return Comment::query()
                    ->join('admins', 'admins.id', '=', 'comments.admin_id')
                    ->select('comments.id', 'comments.comment', 'comments.created_at', 'comments.admin_id', 'admins.name')
                    ->latest('comments.id')
                    ->get();
            });

            $orders = Cache::remember('dashboard_orders', 600, function () use ($statuses) {
                return DB::table('orders')
                    ->join('orderproducts', 'orders.id', '=', 'orderproducts.order_id')
                    ->whereIn('orders.status', $statuses)
                    ->select('orderproducts.product_id', DB::raw('SUM(orderproducts.quantity) as total_amount'), DB::raw('MAX(orders.orderDate) as orderDate'))
                    ->groupBy('orderproducts.product_id')
                    ->orderByDesc('total_amount')
                    ->limit(20)
                    ->get();
            });

            $latestorders = Cache::remember('dashboard_latest_orders', 600, function () use ($statuses) {
                return DB::table('orders')
                    ->join('orderproducts', 'orders.id', '=', 'orderproducts.order_id')
                    ->whereIn('orders.status', $statuses)
                    ->select('orders.id', 'orders.status', 'orders.orderDate', 'orderproducts.product_id', 'orderproducts.quantity')
                    ->latest('orders.orderDate')
                    ->limit(20)
                    ->get();
            });

            $view->with(compact('comments', 'orders', 'latestorders'));
        });

        /*
        |--------------------------------------------------------------------------
        | Webview Header
        |--------------------------------------------------------------------------
        */
        view()->composer('webview.partials.header', function ($view) {
            $basicinfo = Cache::remember('webview_basic_info', 3600, function() {
                return Basicinfo::select('id', 'logo', 'marquee_text', 'phone_one')->first();
            });

            $categories = Cache::remember('webview_header_categories', 3600, function() {
                return Category::with(['subcategories' => function ($query) { 
                    $query->select('id', 'sub_category_name', 'slug', 'category_id')->where('status', 'Active');
                }])->where('status', 'Active')->select('id', 'category_name', 'slug')->get();
            });

            $view->with(compact('basicinfo', 'categories'));
        });

        /*
        |--------------------------------------------------------------------------
        | Backend Sidebar
        |--------------------------------------------------------------------------
        */
        view()->composer('backend.partials.sidebar', function ($view) {
            $menus = Cache::remember('backend_sidebar_menus', 3600, function() {
                return Menu::select('id', 'menu_name', 'slug')->get();
            });

            $view->with(compact('menus'));
        });

        /*
        |--------------------------------------------------------------------------
        | Webview Main Content (Homepage) - Highly Optimized
        |--------------------------------------------------------------------------
        */
        view()->composer('webview.content.maincontent', function ($view) {
            
            // ১ ঘন্টা ক্যাশ থাকবে (স্ট্যাটিক ডাটার জন্য)
            $menus = Cache::remember('home_menus', 3600, function() {
                return Menu::where('status', 'Active')->select('id', 'menu_name', 'slug')->get();
            });

            $categories = Cache::remember('home_categories_sidebar', 3600, function() {
                return Category::with(['subcategories' => function ($query) { 
                    $query->select('id', 'sub_category_name', 'slug', 'category_id')->where('status', 'Active');
                }])
                ->where('status', 'Active')
                ->select('id', 'category_name', 'slug', 'category_icon')
                ->latest()
                ->take(11)
                ->get()
                ->reverse(); // ১১ টি ডাটার ক্ষেত্রে রিভার্স করা মেমরিতে সমস্যা করবে না
            });

            $categorylist = Cache::remember('home_category_list', 3600, function() {
                return Category::where('status', 'Active')->select('id', 'category_name', 'slug', 'category_icon')->get()->chunk(2);
            });

            $sliders = Cache::remember('home_sliders', 3600, function() {
                return Slider::where('status', 'Active')->select('id', 'slider_small_title', 'slider_title', 'slider_text', 'slider_btn_name', 'slider_btn_link', 'slug', 'slider_image')->get();
            });

            $policymenus = Cache::remember('home_policy_menus', 3600, function() {
                return Policymenu::where('status', 'Active')->select('id', 'policy_menu_name', 'policy_text')->get();
            });

            $bottombanners = Cache::remember('home_bottom_banners', 3600, function() {
                return Brand::where('status', 'Active')->select('id', 'brand_name', 'brand_icon')->get();
            });

            $servicepackages = Cache::remember('home_service_packages', 3600, function() {
                return Servicepackage::where('status', 'Active')->select('id', 'servicepackage_name', 'package_text', 'roles')->get();
            });

            $adds = Cache::remember('home_adds', 3600, function() {
                return Addbanner::where('status', 'Active')->select('id', 'add_link', 'add_image', 'status')->take(2)->get();
            });

            $addbottoms = Cache::remember('home_add_bottoms', 3600, function() {
                return Addbanner::where('status', 'Active')->select('id', 'add_link', 'add_image', 'status')->latest()->take(2)->get();
            });

            // ডাইনামিক প্রোডাক্ট কুয়েরি (লিমিট যুক্ত করা হয়েছে এবং ক্যাশ ১০ মিনিটে কমানো হয়েছে)
            $topproducts = Cache::remember('home_top_products', 600, function() {
                return Product::where('status', 'Active')->where('is_sub_product', 0)->where('top_rated', '1')->select('id', 'ProductName', 'ViewProductImage', 'ProductSlug', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->limit(20)->get();
            });

            $featuredproducts = Cache::remember('home_featured_products', 600, function() {
                return Product::where('status', 'Active')->where('is_sub_product', 0)->where('frature', '0')
                    ->select('id', 'weight', 'is_weight', 'ProductName', 'ViewProductImage', 'ProductSlug', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')
                    ->latest() // ডাটাবেজ লেভেলে রিভার্স করার বিকল্প
                    ->limit(20)
                    ->get();
            });

            $bestproducts = Cache::remember('home_best_products', 600, function() {
                return Product::where('status', 'Active')->where('best_selling', '0')->where('is_sub_product', '0')->select('id', 'ProductName', 'weight', 'is_weight', 'ViewProductImage', 'ProductSlug', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->latest()->take(20)->get()->chunk(2);
            });

            $categoryproducts = Cache::remember('home_category_products', 600, function() {
                return Category::with(['products' => function ($query) {  
                    $query->select('id', 'weight', 'is_weight', 'category_id', 'ViewProductImage', 'ProductName', 'ProductSlug', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')
                        ->where('status', 'Active')
                        ->where('is_sub_product', '0')
                        ->limit(10); // প্রতি ক্যাটাগরিতে প্রোডাক্ট লোড করার লিমিট
                }])
                ->where('status', 'Active')
                ->where('front_status', 0)
                ->select('id', 'category_name', 'slug')
                ->get();
            });
        
            $newproducts = Cache::remember('home_new_products', 600, function() {
                return Product::where('status', 'Active')->where('is_sub_product', 0)->select('id', 'ProductName', 'ProductSlug', 'ProductSku', 'ViewProductImage', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->latest()->take(20)->get();
            });

            $bestone = Cache::remember('home_best_one_products', 600, function() {
                return Product::where('status', 'Active')->where('is_sub_product', 0)->select('id', 'ProductName', 'weight', 'is_weight', 'ProductSlug', 'ProductSku', 'ViewProductImage', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->latest()->limit(20)->get()->chunk(2);
            });

            // inRandomOrder() কুয়েরিগুলো কিছুটা স্লো হতে পারে, তবে লিমিট থাকায় নিয়ন্ত্রণে থাকবে
            $specialdeals = Product::where('status', 'Active')->where('is_sub_product', 0)->select('id', 'ProductName', 'ProductSlug', 'weight', 'is_weight', 'ProductSku', 'ViewProductImage', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->inRandomOrder()->limit(15)->get()->chunk(3);
            $specialoffers = Product::where('status', 'Active')->where('is_sub_product', 0)->where('Discount', '>=', '10')->select('id', 'weight', 'is_weight', 'ProductName', 'ViewProductImage', 'ProductSlug', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->inRandomOrder()->limit(15)->get()->chunk(3);
            $hotoffers = Product::where('status', 'Active')->where('is_sub_product', 0)->where('Discount', '>=', '20')->select('id', 'weight', 'is_weight', 'ProductName', 'ProductSlug', 'ViewProductImage', 'ProductSku', 'ProductRegularPrice', 'ProductSalePrice', 'Discount', 'ProductImage')->inRandomOrder()->limit(4)->get();

            $view->with(compact(
                'addbottoms', 'bestproducts', 'categorylist', 'menus', 'categories', 'policymenus', 
                'bottombanners', 'sliders', 'servicepackages', 'newproducts', 'adds', 'featuredproducts', 
                'topproducts', 'categoryproducts', 'bestone', 'specialdeals', 'specialoffers', 'hotoffers'
            ));
        });

        /*
        |--------------------------------------------------------------------------
        | Webview Footer
        |--------------------------------------------------------------------------
        */
        view()->composer('webview.partials.footer', function ($view) {
            $basicinfo = Cache::remember('webview_footer_info', 3600, function() {
                return Basicinfo::first();
            });
            $view->with(compact('basicinfo'));
        });
    }
}