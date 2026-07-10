<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.content.category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category =new Category();
        $category->category_name =$request->category_name;
         $category->slug =$request->slug;
        $category_icon = $request->file('category_icon');
        $name = time() . "_" . $category_icon->getClientOriginalName();
        $uploadPath = ('public/images/category/'); 
        $category_icon->move($uploadPath, $name);
        $category_iconImgUrl = $uploadPath . $name;
        $webp = $category_iconImgUrl;
        $im = imagecreatefromstring(file_get_contents($webp));
        $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $webp);
        imagewebp($im, $new_webp, 50);
        $category->category_icon = $new_webp; 
        $category->save();
        return response()->json($category, 200);
    }

    public function categorydata()
    {
        $categorys = Category::all();
        return Datatables::of($categorys)
        
            ->addColumn('action', function ($categorys) {
                    return view('backend.content.category.action', compact('categorys'));
                })
       

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return response()->json($category, 200);
    }

    /**
     * Get Subcategories by Category ID(s)
     *
     * 🔹 Supports:
     * - Single ID → /get/subcategory/36
     * - Multiple IDs → /get/subcategory/36,37,38
     *
     * 🔹 আচরণ:
     * - No data found → returns status false + message
     * - Single data → returns single object
     * - Multiple data → returns collection
     *
     * @param string $id (comma separated category IDs)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getsubcategory($id)
    {
        // 🔹 নিরাপদভাবে string → array (int)
        $ids = array_map('intval', explode(',', $id));
    
        // 🔹 query
        $subcategory = Subcategory::whereIn('category_id', $ids)
            ->where('status', 'Active')
            ->get();
    
        // 🔴 যদি কিছুই না পাওয়া যায়
        if ($subcategory->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No subcategory found',
                'data' => []
            ], 200);
        }
    
        // 🟡 যদি মাত্র ১টা পাওয়া যায়
        if ($subcategory->count() === 1) {
            return response()->json([
                'status' => true,
                'message' => 'Single subcategory found',
                'data' => $subcategory->first()
            ], 200);
        }
    
        // 🟢 একাধিক data
        return response()->json([
            'status' => true,
            'message' => 'Subcategories list',
            'data' => $subcategory
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        $category->category_name =$request->category_name;
        $category->slug =$request->slug;
        if($request->category_icon){ 
            $category_icon = $request->file('category_icon');
            $name = time() . "_" . $category_icon->getClientOriginalName();
            $uploadPath = ('public/images/category/'); 
            $category_icon->move($uploadPath, $name);
            $category_iconImgUrl = $uploadPath . $name; 
            $webp = $category_iconImgUrl;
            $im = imagecreatefromstring(file_get_contents($webp));
            $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $webp);
            imagewebp($im, $new_webp, 50);
            $category->category_icon = $new_webp;
        }
        $category->save();
        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return response()->json('success', 200);
    }

    public function statusupdate(Request $request)
    {
        $category = Category::where('id',$request->category_id)->first();
        if(isset($request->status)){
            $category->status=$request->status;
        }
        if(isset($request->front_status)){
            $category->front_status=$request->front_status;
        }
        $category->update();
        return response()->json($category, 200);
    }
}