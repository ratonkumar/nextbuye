<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attrvalue;
use App\Models\Attribute;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\Purchase;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes=Attrvalue::where('attribute_id',2)->where('status','Active')->get();
        $colors=Attrvalue::where('attribute_id',3)->where('status','Active')->get();
        $weights=Attrvalue::where('attribute_id',1)->where('status','Active')->get();
        $categories =Category::where('status','Active')->select('id','category_name','status')->get();
        $brands =Brand::where('status','Active')->select('id','brand_name','status')->get();
        $subcategories =Subcategory::where('status','Active')->select('id','sub_category_name')->get();
        
        $singleProductList = Product::where('is_sub_product', 1)->get();
        return view('backend.content.product.index',['brands'=>$brands,'singleProductList'=>$singleProductList,'weights'=>$weights,'colors'=>$colors,'sizes'=>$sizes,'categories'=>$categories,'subcategories'=>$subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusupdate(Request $request)
    {
        $product=Product::where('id',$request->product_id)->first();
        $product->status=$request->status;
        $product->update();
        return response()->json($product, 200);
    }

    public function featurestatusupdate(Request $request)
    {
        $product=Product::where('id',$request->product_id)->first();
        $product->frature=$request->frature;
        $product->update();
        return response()->json($product, 200);
    }

    public function bestsellstatusupdate(Request $request)
    {
        $product=Product::where('id',$request->product_id)->first();
        $product->best_selling=$request->best;
        $product->update();
        return response()->json($product, 200);
    }

    public function ratedstatusupdate(Request $request)
    {
        $product=Product::where('id',$request->product_id)->first();
        $product->top_rated=$request->top_rated;
        $product->update();
        return response()->json($product, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->ProductName = $request->ProductName;
        $product->ProductBreaf = $request->ProductBreaf;
        $product->ProductDetails = $request->ProductDetails;
        $product->ProductSku = $request->ProductSku;
        $product->ProductRegularPrice = $request->ProductRegularPrice;
        $product->Discount=$request->Discount;
        $product->ProductSalePrice=$request->ProductSalePrice;
 
        $product->youtube_embade= $request->youtube_embade;
        $product->brand_id= $request->brand_id;
        $product->category_id = json_encode($request->category_id);
        $product->subcategory_id= json_encode($request->subcategory_id);
        // $product->subcategory_id= $request->subcategory_id;
        $product->ProductSlug= $request->ProductSlug;
         $product->is_weight= $request->is_weight;
         $product->is_sub_product= $request->is_sub_product;
        // কালার আপডেট (যদি না থাকে তবে খালি অ্যারে সেভ হবে)
        $product->color = json_encode($request->input('color', []));
        
        // সাইজ আপডেট (যদি না থাকে তবে খালি অ্যারে সেভ হবে)
        $product->size = json_encode($request->input('size', []));

        if ($request['outer-group'] && $request->is_weight == 1) {
            $product->weight = json_encode($request['outer-group']);
        } else {
             $product->weight = NULL;
        }
        

        // if ($request['outer-group']) {
        //     $product->weight = json_encode($request['outer-group']);
        // }

        $time = microtime('.') * 10000;

        $productImg = $request->file('ProductImage');
        if($productImg){
            $imgname = $time . $productImg->getClientOriginalExtension();
            $imguploadPath = ('public/images/product/image/');
            $productImg->move($imguploadPath, $imgname);
            $productImgUrl = $imguploadPath . $imgname;
            $product->ProductImage = $productImgUrl;
            $webp = $productImgUrl;
            $im = imagecreatefromstring(file_get_contents($webp));
            $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $webp);
            imagewebp($im, $new_webp, 50);
            $product->ViewProductImage = $new_webp;
        }

        if ($request->hasFile('PostImage')) {
            foreach ($request->file('PostImage') as $imgfiles) {
                $name = time() . "_" . $imgfiles->getClientOriginalName();
                $imgfiles->move(public_path() . '/images/product/slider/', $name);
                $imageData[] = $name;
            }
            $product->PostImage = json_encode($imageData);
        };

        $result=$product->save();
        
        $categoryID = $request->category_id;
        if(!empty($categoryID)) {
            foreach($categoryID as $catID) {
                DB::table('category_product')->insert(
                    [
                        'product_id'  => $product->id, 
                        'category_id' => $catID
                    ]
                );
            }
            
        }
       
        if ($result) {
            $latestStock = new Stock();
            $latestStock->product_id = $product->id;
            $latestStock->purchase = 0;
            $latestStock->stock = 100;
            $latestStock->save();
            $purchase = new Purchase();
            $purchase->date = date('Y-m-d');
            $purchase->invoiceID = date('Y-m-d');
            $purchase->product_id = $product->id;
            $purchase->supplier_id = 1;
            $purchase->quantity = 100;
            $purchase->save();
        }

        return response()->json($product, 200);
    }

    public function sku()
    {
        $lastProduct = Product::latest('id')->first();
        if ($lastProduct) {
            $ProductID = $lastProduct->id + 1;
        } else {
            $ProductID = 1;
        }

        return 'BNL000' . $ProductID;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productdata()
    {
        $products = Product::all();
        return Datatables::of($products)
            ->addColumn('action', function ($products) {
                return '<a href="#" type="button" id="editProductBtn" data-id="' . $products->id . '"   class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editmainProduct" style="margin-bottom:2px;"><i class="bi bi-pencil-square"></i></a>
                <a href="#" type="button" style="margin-bottom:2px;" id="deleteProductBtn" data-id="' . $products->id . '" class="btn btn-danger btn-sm" ><i class="bi bi-archive" ></i></a>  <a href="#" type="button" style="margin-bottom:2px;" id="copyBtnData" data-id="' . $products->id . '" class="btn btn-info btn-sm" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
</svg></a>';
            })

            ->make(true);
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productCopy($id)
    {
        $product = Product::find($id);
       
        $newData = $product->replicate(); // Duplicate it
        $newData->ProductSlug = $newData->ProductSlug.rand(1, 100);
        $newData->save(); // Save to new location
        return response()->json($product, 200);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productOrder(Request $request,$id)
    {
        $product = Product::find($id);

        $product->order_no = $request->order;
        $product->save(); // Save to new location
        return response()->json($product, 200);
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productImageRemove(Request $request,$id)
    {
        $product = Product::find($id);

        $product->ProductImage ='';
        $product->ViewProductImage ='';
        $product->save(); // Save to new location
        return response()->json($product, 200);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productgalleryImageRemove(Request $request,$id)
    {
        $product = Product::find($id);

        $product->PostImage ='';
   
        $product->save(); // Save to new location
        return response()->json($product, 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::where('id',$id)->first();
        return response()->json($product, 200);
    }
    
  public function removeGalleryImage(Request $request)
{
    $productId = $request->product_id;
    $imageName = $request->image_name;

    // ১. ডাটাবেজ থেকে প্রোডাক্টটি খুঁজে বের করা
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'প্রোডাক্ট পাওয়া যায়নি!']);
    }

    // ২. গ্যালারি ইমেজের কলামটি নেওয়া (ধরে নিচ্ছি কলামের নাম 'images' বা 'gallery')
    // যদি আপনার মডেলে $casts = ['images' => 'array'] করা না থাকে, তবে json_decode করতে হবে
    $images = is_array($product->PostImage) ? $product->PostImage : json_decode($product->PostImage, true);

    if (!empty($images) && in_array($imageName, $images)) {
        
        // ৩. সার্ভারের ফোল্ডার (public/images/product/slider/) থেকে ফাইলটি ডিলিট করা
        $imagePath = public_path('images/product/slider/' . $imageName);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // ৪. অ্যারে থেকে নির্দিষ্ট ইমেজটি মাইনাস/বাদ দেওয়া
        $updatedImages = array_values(array_diff($images, [$imageName]));

        // ৫. ডাটাবেজে নতুন অ্যারেটি সেভ করা
        $product->PostImage = $updatedImages; // মডেলে কাস্ট করা থাকলে সরাসরি অ্যারে সেভ হবে, নাহলে json_encode($updatedImages) দিন
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'ছবিটি সফলভাবে ডিলিট করা হয়েছে।'
        ]);
    }

    return response()->json(['success' => false, 'message' => 'ছবিটি ডাটাবেজে খুঁজে পাওয়া যায়নি!']);
}
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productCategoryEdit($id)
    {
        $product = DB::table('category_product')->where('product_id',$id)->get();
        $categories =Category::where('status','Active')->select('id','category_name','status')->get();
        
        return view('backend.content.product.edit_categories',['product'=>$product, 'categories' => $categories]);
        
    }
    
         /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productPageEdit($id)
    {
        $product = Product::where('id',$id)->first();
        
        $singleProductList = Product::where('is_sub_product', 1)->get();
        $categories =Category::where('status','Active')->select('id','category_name','status')->get();
        $subProductID = [];
        if(!empty($product->sub_product_id)) {
             $subProductID  = json_decode($product->sub_product_id);
        }
        return view('backend.content.product.edit_single_page',['product'=>$product, 'categories' => $categories, 'singleProductList' => $singleProductList, 'subProductID' => $subProductID]);
        
    }
    
    
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
   public function productWightEdit($id)
    {
        $product = Product::find($id); // Short way to find by ID
    
        if (!$product) {
            return 201;
        }
    
        // JSON decode korar por jodi data na thake, tobe empty array set korbe
        $weight = json_decode($product->weight, true) ?? [];
    
        return view('backend.content.product.edit_weight', [
            'weightInfo' => $weight,
            'product' => $product // Product ID lagte pare form submit er jonno
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::where('id',$id)->first();
        $product->ProductName = $request->ProductName;
        $product->ProductBreaf = $request->ProductBreaf;
        $product->ProductDetails = $request->ProductDetails;
        $product->ProductRegularPrice = $request->ProductRegularPrice;
        $product->Discount=$request->Discount;
        $product->ProductSalePrice=$request->ProductSalePrice;
        $product->category_id = json_encode($request->category_id);
        $product->subcategory_id= json_encode($request->subcategory_id);
        $product->youtube_embade= $request->youtube_embade;
       
        $product->brand_id= $request->brand_id;
        $product->ProductSku = $request->ProductSku;
        $product->is_single_page  = $request->is_single_page;
        $product->is_sub_product= $request->is_sub_product;
        if($request->is_single_page == 1) {
           
            $product->subTitleHEader = $request->subTitleHEader;
            $product->ProductDetails1 = $request->ProductDetails1;
            $product->subTitle1       = $request->subTitle1;
            $product->ProductDetails2 = $request->ProductDetails2;
            $product->subTitle2       = $request->subTitle2;
            $product->ProductDetails3 = $request->ProductDetails3;
            $product->subTitle3       = $request->subTitle3;
            $product->sub_product_id  = json_encode($request->sub_product_id);;
            
        } else {
            $product->subTitleHEader = NULL;
             $product->ProductDetails1 = NULL;
            $product->subTitle1        = NULL;
            $product->ProductDetails2  = NULL;
            $product->subTitle2        = NULL;
            $product->ProductDetails3  = NULL;
            $product->subTitle3        = NULL;
            $product->sub_product_id   = NULL;
        }
        // সুইচ অন থাকলে ডাটা আপডেট হবে
        $product->is_specs_active = $request->has('is_specs_active') ? 1 : 0;
    
        $product->ProductSlug= $request->ProductSlug;
        $product->is_weight= $request->edit_is_weight;
       // কালার আপডেট (যদি না থাকে তবে খালি অ্যারে সেভ হবে)
        $product->color = json_encode($request->input('color', []));
        
        // সাইজ আপডেট (যদি না থাকে তবে খালি অ্যারে সেভ হবে)
        $product->size = json_encode($request->input('size', []));

         if (is_array($request['outer-group']) && $request['outer-group'] && $request->edit_is_weight == 1) {
            $product->weight = json_encode($request['outer-group']);
        } elseif($request->edit_is_weight == 0) {
             $product->weight = NULL;
        }

        $time = microtime('.') * 10000;

        $productImg = $request->file('ProductImage');

        if($productImg){
            // unlink($product->ProductImage);
            // unlink($product->ViewProductImage);
            $imgname = $time . $productImg->getClientOriginalExtension();
            $imguploadPath = ('public/images/product/image/');
            $productImg->move($imguploadPath, $imgname);
            $productImgUrl = $imguploadPath . $imgname;
            $product->ProductImage = $productImgUrl;
            $webp = $productImgUrl;
            $im = imagecreatefromstring(file_get_contents($webp));
            $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $webp);
            imagewebp($im, $new_webp, 50);
            $product->ViewProductImage = $new_webp;
        }

        if ($request->hasFile('PostImage')) {
            // if($product->PostImage){
            //     foreach (json_decode($product->PostImage) as $postimg) {
            //         unlink('public/images/product/slider/' . $postimg);
            //     }
            // }
            
            $preImage = json_decode($product->PostImage);
            $imageData =[];
            if(!empty($preImage)) {
                foreach($preImage as $preImage) {
                    $imageData[] = $preImage;
            }
            }
            foreach ($request->file('PostImage') as $imgfiles) {
                $name = time() . "_" . $imgfiles->getClientOriginalName();
                $imgfiles->move(public_path() . '/images/product/slider/', $name);
                $imageData[] = $name;
            }
            $product->PostImage = json_encode($imageData);
        }

        $product->save();
        
        // স্পেসিফিকেশন ডিলিট করে নতুন ডাটা ইনসার্ট করা
        $product->specifications()->delete();
        if($request->has('specs')) {
            foreach($request->specs as $spec) {
                if(!empty($spec['label'])) {
                    $product->specifications()->create($spec);
                }
            }
        }
         $categoryID = $request->category_id;
        if(!empty($categoryID)) {
            DB::table('category_product')->where('product_id',  $product->id)->delete();
            foreach($categoryID as $catID) {
                
                DB::table('category_product')->insert(
                    [
                        'product_id'  => $product->id, 
                        'category_id' => $catID
                    ]
                );
            }
            
        }

        if($product){
            return response()->json($product, 200);
        }else{
            return response()->json('error', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->ProductImage){
            // unlink($product->ProductImage);
        }
        $product->delete();
        return response()->json('success',200);
    }
}
