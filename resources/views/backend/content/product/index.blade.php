@extends('backend.master')

@section('maincontent')
@section('title')
    {{ env('APP_NAME') }}- Products
@endsection
   
<style>
    button.remove {
        position: absolute;
        left: 0px;
        z-index: 999;
        width: 27px;
    }

    div#roleinfo_length {
        color: red;
    }

    div#roleinfo_filter {
        color: red;
    }

    div#roleinfo_info {
        color: red;
    }
    .outer {
        margin-bottom: 5px;
        margin-top: 5px;
    }
    .select2-dropdown {

    z-index: 999999999 !important;
}

button.remove {
    position: absolute;
    right: 10px;
}
</style>
{{-- summernote --}}
<!-- jQuery -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!-- Bootstrap -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<!--<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">-->

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="h-100 bg-third rounded p-4 pb-0">
                <div class="d-flex align-items-center justify-content-between" style="width: 50%;float:left;">
                    <h6 class="mb-0">Products List</h6>
                </div>
                <div class="" style="width: 50%;float:left;">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#mainProduct" class="btn btn-primary m-2"
                        style="float: right"> + Create New Product</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="bg-third rounded h-100 p-4">
                <div class="data-tables table-responsive">
                    <table class="table table-dark" id="productinfo" width="100%" style="text-align: center;">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Sale Price</th>
                                <th>Discount</th>
                                <th>Order</th>
                                <th>Combo</th>
                                 <th>Type</th>
                                <th>Featured</th>
                                <th>Promotion</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- create product modal --}}
        <div class="modal fade" id="mainProduct" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-third rounded h-100">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: red;">Create New Product</h5>
                        <button type="button" class="btn-dark btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form name="form" id="AddProduct" class="outer-repeater" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                                    <div class="form-group mb-3">
                                        <label for="ProductName">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="ProductName" id="ProductName" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ProductSlug">Custom Url <span class="text-danger">*</spa <span class="text-danger">*</span> </label>
                                        <input type="text" id="ProductSlug" name="ProductSlug" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ProductSku">Product SKU <span class="text-danger">*</spa <span class="text-danger">*</span> </label>
                                        <input type="text" id="ProductSku" name="ProductSku" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Sale Price <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="ProductSalePrice"
                                                    name="ProductSalePrice" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Regular Price <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="ProductRegularPrice" name="ProductRegularPrice"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Discount (%) </label>
                                                <input type="number" id="Discount" name="Discount"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductCategory" style="width: 100%;">Brand Name </label>
                                                <select class="form-control" id="brand_id" style="background: black;" name="brand_id">
                                                    <option>Select Brands</option>
                                                    @forelse ($brands as $brand)
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductCategory" style="width: 100%;">Categories <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" id="category_id" style="background: black;"
                                                    name="category_id[]" onchange="setsubcategory()" required multiple>
                                                    <option>Select Category</option>
                                                    @forelse ($categories as $category)
                                                        <option value="{{ $category->id }}" seleted>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductCategory" style="width: 100%">Sub Category <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2 " id="sub_category_id"
                                                    style="background: black;" name="subcategory_id[]" multiple >
                                                    <option>Select Sub-Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ProductRegularPrice">Product Short Description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="ProductBreaf" rows="2"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ProductDetailsss">Product Description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="ProductDetails" name="ProductDetails" rows="5"></textarea>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                        
                                            
                                             $('#ProductDetails').summernote({
                                                dialogsInBody: true,  
                                                height: 300,
                                                toolbar: [
                                                    ['style', ['style']],
                                                    ['font', ['bold', 'italic', 'underline', 'clear']],
                                                    ['fontname', ['fontname']],
                                                    ['fontsize', ['fontsize']],
                                                    ['color', ['color']],
                                                    ['para', ['ul', 'ol', 'paragraph']],
                                                    ['height', ['height']],
                                                    ['table', ['table']],
                                                    ['insert', ['link', 'picture', 'video']],
                                                    ['view', ['fullscreen', 'codeview', 'help']]
                                              ],
                                                popover: { image: [], link: [], air: [] }, // Prevent conflicts with Bootstrap modals
                                            });
                                        });
                                    </script>

                                </div>

                                <div class="col-lg-6">

                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Youtube Embade Code</label>
                                                <input type="text" id="youtube_embade" name="youtube_embade"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductDetails">Product Image <span
                                                        class="text-danger">*</span></label>
                                                <button type="button" class="btn btn-danger d-block mb-2"
                                                    style="background: red">
                                                    <input type="file" name="ProductImage" id="ProductImage"
                                                        onchange="loadFile(event)">
                                                </button>
                                                <div class="single-image image-holder-wrapper clearfix">
                                                    <div class="image-holder placeholder" style="width: 200px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                                        <img id="prevImage" style="max-width: 100%; max-height: 100%; object-fit: cover;" />
                                                        <i class="mdi mdi-folder-image" id="placeholderIcon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="form-group"
                                                style="padding: 10px;padding-top: 3px;margin:0;padding-bottom:3px;width:96%;margin-left: 8px;border-radius: 8px;padding-left: 0;margin-left: -0;">
                                                <label class="fileContainer">
                                                    <span style="font-size: 20px;">Product Slider
                                                        image</span>
                                                </label>
                                                <br>
                                                <button type="button" class="btn btn-danger d-block mb-2"
                                                    style="background: red">
                                                    <input type="file" onchange="prevPost_Img()"
                                                        name="PostImage[]" id="PostImage" multiple>
                                                </button>
                                            </div>
                                            <div class="file">
                                                <div id="prevFile"
                                                    style="width: 100%;float:left;background: lightgray;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductRegularPrice">Colour
                                                    <span class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($colors as $color)
                                                    <input type="checkbox" name="color[]"
                                                        value="{{ $color->value }}">
                                                    {{ $color->value }} &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Size <span
                                                        class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($sizes as $size)
                                                    <input type="checkbox" name="size[]"
                                                        value="{{ $size->value }}">
                                                    {{ $size->value }} &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        {{--
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Weights <span
                                                        class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($weights as $weight)
                                                    <input type="checkbox" name="weight[]"
                                                        value="{{ $weight->value }}"> {{ $weight->value }}
                                                    &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        --}}


                                    </div>
                                   

                                </div>
                                 <div class="row" >
                                    <div class="col-12">
                                        <label for="is_sub_product">Category Status ? <span  class="text-danger">*</span></label>
                                        <br>
                                        <select class="form-control" id="is_sub_product" name="is_sub_product" >
                                            <option value="0" selected> Parent</option>
                                            <option value="1"> Child</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-12">
                                        <label for="is_weight">Add Weight ? <span  class="text-danger">*</span></label>
                                        <br>
                                        <select class="form-control" id="is_weight" name="is_weight" onchange="weightChange()">
                                            <option value="1"> Yes</option>
                                            <option value="0" selected> No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="weight_id_hidden" style="display:none">
                                    <label for="ProductSalePrice">Weights <span  class="text-danger">*</span></label>
                                    <br>
                                   <div data-repeater-list="outer-group" class="outer">
                                        <div data-repeater-item class="outer">
                                            <div class="row">
                                                <div class="col-4">
                                                   <input type="text" name="weight" placeholder="Weight here" class="form-control outer"/>
                                                </div>
                                                <div class="col-3">
                                                   <input type="text" name="regular_price" placeholder="Regular Price"  class="form-control outer"/>
                                               </div>
                                                 <div class="col-3">
                                                   <input type="text" name="sale_price" placeholder="Sale Price "  class="form-control outer"/>
                                               </div>
                                               <div class="col-2">
                                                    <input data-repeater-delete type="button" value="Delete" class="btn btn-danger outer"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <input data-repeater-create type="button" value="Add" class="btn btn-warning outer"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group mt-2" style="text-align: right">
                                <div class="submitBtnSCourse">
                                    <button type="submit" name="btn" data-bs-dismiss="modal"
                                        class="btn btn-dark btn-block" style="float: left">Close</button>
                                    <button type="submit" name="btn"
                                        class="btn btn-primary AddCourierBtn btn-block">Save</button>
                                </div>
                            </div>
                        </form>
                         <form action="#" class="outer-repeater">
                           
                            </form>
                    </div>

                </div>
            </div>
        </div><!-- End popup Modal-->

        {{-- edit payment icon --}}
        <div class="modal fade" id="editmainProduct" tabindex="-1" style="    overflow: scroll;
   ">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-third rounded h-100">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: red;">Edit Product</h5>
                        <button type="button" class="btn-dark btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form name="form" id="EditProduct" class="outer-repeater" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>
                                    <input type="text" name="product_id" id="product_id" hidden>
                                    <div class="form-group mb-3">
                                        <label for="ProductName">Product Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="ProductName" id="ProductName"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ProductSlug">Custom Url <span class="text-danger">*</spa <span class="text-danger">*</span> </label>
                                        <input type="text" id="ProductSlug" name="ProductSlug" class="form-control" required>
                                    </div>
                                     <div class="form-group mb-3">
                                        <label for="ProductSku">Product SKU <span class="text-danger">*</spa <span class="text-danger">*</span> </label>
                                        <input type="text" id="ProductSku" name="ProductSku" class="form-control" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductRegularPrice">Sale Price <span
                                                        class="text-danger">*</span></label>
                                                <input type="number"  id="EditProductSalePrice"
                                                    name="ProductSalePrice" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Regular Price <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="EditProductRegularPrice" name="ProductRegularPrice"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Discount (%) </label>
                                                <input type="number" id="EditDiscount" name="Discount"
                                                    class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ProductCategory" style="width: 100%;">Brand Name </label>
                                                <select class="form-control" id="brand_id" style="background: black;" name="brand_id">
                                                    <option>Select Brands</option>
                                                    @forelse ($brands as $brand)
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3" id="productCateEdit">
                                                <label for="editcategory_id" style="width: 100%;">Categories <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="editcategory_id"
                                                    style="background: black;" name="category_id[]"
                                                    onchange="editsetsubcategory()" multiple>
                                                    <option>Select Category</option>
                                                    @forelse ($categories as $category)
                                                        <option value="{{ $category->id }}" selected >
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="editsub_category_id" style="width: 100%">Sub Category <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" id="editsub_category_id"
                                                    style="background: black;" name="subcategory_id[]" multiple >
                                                    <option>Select Sub-Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ProductRegularPrice">Product Short Description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="ProductBreaf" id="editProductBreaf" rows="2"></textarea>
                                    </div>

                                    <div class="form-group mb-3" id="descriptionPro">

                                    </div>

                                </div>

                                <div class="col-lg-6">


                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Youtube Embade Code</label>
                                                <input type="text" id="youtube_embade" name="youtube_embade"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductDetails">Product Image <span
                                                        class="text-danger">*</span></label>
                                                <button type="button" class="btn btn-danger d-block mb-2">
                                                    <input type="file" name="ProductImage" id="ProductImage"
                                                        onchange="editloadFile(event)">
                                                </button>
                                                <div class="single-image image-holder-wrapper clearfix">
                                                    <div class="image-holder placeholder">
                                                        <div id="previmg"> </div>
                                                        <img id="editprevImage" style="height: 80px" />
                                                        <i class="mdi mdi-folder-image"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <div class="form-group"
                                                style="padding: 10px;padding-top: 3px;margin:0;padding-bottom:3px;width:96%;margin-left: 8px;border-radius: 8px;padding-left: 0;margin-left: -0;">
                                                <label class="fileContainer">
                                                    <span style="font-size: 20px;">Product Slider
                                                        image</span>
                                                </label>
                                                <br>
                                                <button type="button" class="btn btn-danger d-block mb-2"
                                                    style="background: red">
                                                    <input type="file" onchange="editprevPost_Img()"
                                                        name="PostImage[]" id="editPostImage" multiple>
                                                </button>
                                            </div>
                                            <div class="file">
                                                <div id="editprevFile"
                                                    style="width: 100%;float:left;background: lightgray;">

                                                </div>
                                                <div id="viewprevFile"
                                                    style="width: 100%;float:left;background: lightgray;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductRegularPrice">Colour
                                                    <span class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($colors as $color)
                                                    <input type="checkbox" name="color[]"
                                                        value="{{ $color->value }}">
                                                    {{ $color->value }} &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Size <span
                                                        class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($sizes as $size)
                                                    <input type="checkbox" name="size[]"
                                                        value="{{ $size->value }}">
                                                    {{ $size->value }} &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        {{--
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="ProductSalePrice">Weights <span
                                                        class="text-danger">*</span></label>
                                                <br>
                                                @forelse ($weights as $weight)
                                                    <input type="checkbox" name="weight[]"
                                                        value="{{ $weight->value }}"> {{ $weight->value }}
                                                    &nbsp;
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-12">
                                        <label for="is_sub_product">Category Status ? <span  class="text-danger">*</span></label>
                                        <br>
                                        <select class="form-control" id="edit_sub_product" name="is_sub_product" >
                                            <option value="0" selected> Parent</option>
                                            <option value="1"> Child</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-12">
                                        <label for="edit_is_weight">Add Weight ? <span  class="text-danger">*</span></label>
                                        <br>
                                        <select class="form-control" id="edit_is_weight" name="edit_is_weight" onchange="editweightChange()">
                                            <option value="1"> Yes</option>
                                            <option value="0" selected> No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="edit_weight_id_hidden" style="display:none">
                                    
                             
                                    <label for="ProductSalePrice">Weights <span  class="text-danger">*</span></label>
                                    <br>
                                    <div data-repeater-list="outer-group" class="outer" id="weightEdit">
                                        <div data-repeater-item class="outer">
                                            <div class="row">
                                                <div class="col-4">
                                                   <input type="text" name="weight" placeholder="Weight here" class="form-control outer"/>
                                                </div>
                                                <div class="col-3">
                                                   <input type="text"  name="regular_price" placeholder="Regular Price"  class="form-control outer"/>
                                               </div>
                                                 <div class="col-3">
                                                   <input type="text"  name="sale_price" placeholder="Sale Price "  class="form-control outer"/>
                                               </div>
                                               <div class="col-2">
                                                    <input data-repeater-delete type="button" value="Delete" class="btn btn-danger outer"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <input data-repeater-create type="button" value="Add" class="btn btn-warning outer"/>
                                        </div>
                                    </div>
                                </div>
                                
                               <div class="row" >
                                    <div class="col-12">
                                        <label for="single_page">Add Single page ? <span  class="text-danger">*</span></label>
                                        <br>
                                        <select class="form-control" id="is_single_page" name="is_single_page" onchange="editsingle_pageChange()">
                                            <option value="1"> Yes</option>
                                            <option value="0" selected> No</option>
                                        </select>
                                    </div>
                                    
                                   
                                    
                                    
                                    <div id="edit_page_id_hidden">
                                        <div class="col-12">
                                            <label for="single_page">Add Sub Product <span  class="text-danger">*</span></label>
                                            <br>
                                            <select class="form-control select2" id="sub_product_id" name="sub_product_id[]" multiple  >
                                                <option value="0"> select Product</option>
                                               @foreach ($singleProductList as $singleProduct)
                                                    <option value="{{ $singleProduct->id }}"> {{ $singleProduct->ProductName }}
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="single_page">Sub Title</label>
                                                <input type="text" id="subTitle1" name="subTitle1"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="ProductDetailsss">Product Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="ProductDetails1" name="ProductDetails1" rows="5"></textarea>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="single_page">Sub Title(1)</label>
                                                <input type="text" id="subTitle2" name="subTitle2"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="ProductDetailsss">Product Description(1) <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="ProductDetails2" name="ProductDetails2" rows="5"></textarea>
                                        </div>
                                        
                                          <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="single_page">Sub Title(2)</label>
                                                <input type="text" id="subTitle3" name="subTitle3"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="ProductDetailsss">Product Description(2) <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="ProductDetails3" name="ProductDetails3" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#ProductDetails1').summernote();
                                            $('#ProductDetails2').summernote();
                                            $('#ProductDetails3').summernote();
                                            
                                            $('#subTitle1').summernote();
                                            $('#subTitle2').summernote();
                                            $('#subTitle3').summernote();
                                        });
                                        
                                        
                                    </script>
                                </div>
                            </div>
                            <br>
                            <div class="form-group mt-2" style="text-align: right">
                                <div class="submitBtnSCourse">
                                    <button type="submit" name="btn" data-bs-dismiss="modal"
                                        class="btn btn-dark btn-block" style="float: left">Close</button>
                                    <button type="submit" name="btn"
                                        class="btn btn-primary AddCourierBtn btn-block">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div><!-- End popup Modal-->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </div>
</div>
<!-- Include jQuery -->
<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editcategory_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
        $('#editsub_category_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
        $('#category_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
        $('#sub_category_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
        
        
         $('#sub_product_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
    });
  
  
</script>
         
<script>
    $(document).ready(function() {
        function calculateDiscount() {
            var salePrice = parseFloat($('#ProductSalePrice').val());
            var regularPrice = parseFloat($('#ProductRegularPrice').val());

            if (!isNaN(salePrice) && !isNaN(regularPrice) && regularPrice > 0) {
                var discount = Math.round(((regularPrice - salePrice) / regularPrice) * 100);
                $('#Discount').val(discount);
            } else {
                $('#Discount').val('');
            }
        }

        $('#ProductSalePrice, #ProductRegularPrice').on('input', calculateDiscount);
    });
</script>
<script>
    $(document).ready(function() {

        function editcalculateDiscount() {
            var salePrice = parseFloat($('#EditProductSalePrice').val());
            var regularPrice = parseFloat($('#EditProductRegularPrice').val());

            // ðŸ”´ à¦¯à¦¦à¦¿ sale > regular à¦¹à§Ÿ
            if (!isNaN(salePrice) && !isNaN(regularPrice) && salePrice > regularPrice) {
                // /alert('Sale price cannot be greater than Regular price');

                //$('#EditProductSalePrice').val('');
                $('#EditDiscount').val('');
                return;
            }

            // âœ… normal discount calculation
            if (!isNaN(salePrice) && !isNaN(regularPrice) && regularPrice > 0) {
                var discount = Math.round(((regularPrice - salePrice) / regularPrice) * 100);
                $('#EditDiscount').val(discount);
            } else {
                $('#EditDiscount').val('');
            }
        }

        $('#EditProductSalePrice, #EditProductRegularPrice')
            .on('input', editcalculateDiscount);

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<script>

        function productImageRemove(productId){
            swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this !",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: 'GET',
                                url: 'products-image-remove/' + productId ,
                
                                success: function(data) {
                                    // location.reload();
                                   $('#previmg').html('');
                                  
                                },
                                error: function(error) {
                                    console.log('error');
                                }
                
                            });
                        }
             });
        } 

        function productSingleGalleryImageRemove(productId, imageName, index, buttonElement) {
            if (confirm("আপনি কি এই ছবিটি ডিলিট করতে চান?")) {
                $.ajax({
                    url: 'product/gallery-image/remove', // আপনার রাউট URL
                    type: 'get',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF টোকেন
                        product_id: productId,
                        image_name: imageName
                    },
                    success: function(response) {
                        if (response.success) {
                            // সফলভাবে ডিলিট হলে ফ্রন্টএন্ড থেকে ওই ইমেজের বক্সটি রিমুভ করে দেবে
                            $(buttonElement).closest('.postImg').remove();
                            alert(response.message);
                        } else {
                            alert(response.message || "কিছু একটা সমস্যা হয়েছে!");
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("সার্ভারে রিকোয়েস্ট পাঠাতে সমস্যা হয়েছে।");
                    }
                });
            }
        }
        
         function productGalleryImageRemove(productId){
            swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this !",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: 'GET',
                                url: 'products-gallery-image-remove/' + productId ,
                
                                success: function(data) {
                                    // location.reload();
                                   
                                  $('#viewprevFile').html('');
                                },
                                error: function(error) {
                                    console.log('error');
                                }
                
                            });
                        }
             });
        } 
        
        
        
        function orderNoSave(id) {
            let order = $("#data_"+ id).val();
            $.ajax({
                type: 'GET',
                url: 'product_order_no_save/' + id+'?order='+ order,

                success: function(data) {
                    
                },
                error: function(error) {
                    console.log('error');
                }


            });
          
        }
        
    function weightChange() {
     
        var isWeight = $('#is_weight').val();
        if(isWeight == 1) {
            $('#weight_id_hidden').show();
        } else {
            $('#weight_id_hidden').hide();
        }
    }
    
     function editsingle_pageChange() {
     
        var is_single_page = $('#is_single_page').val();
        if(is_single_page == 1) {
            $('#edit_page_id_hidden').show();
        } else {
            $('#edit_page_id_hidden').hide();
        }
    }
    
    
      function editweightChange() {
     
        var isWeight = $('#edit_is_weight').val();
        if(isWeight == 1) {
            $('#edit_weight_id_hidden').show();
        } else {
            $('#edit_weight_id_hidden').hide();
        }
    }
    
    
    $(document).ready(function() {
        var token = $("input[name='_token']").val();

        var productinfo = $('#productinfo').DataTable({
            order: [
                [0, 'desc']
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.product.data') !!}',
            columns: [{
                    data: 'id'
                }, {
                    data: 'ProductImage',
                    name: 'ProductImage',
                    render: function(data, type, full, meta) {
                        return "<img src=../" + data + " height=\"40\" alt='No Image'/>";
                    }
                },
                {
                    data: 'ProductName'
                },
                {
                    data: 'ProductSku'
                },
                {
                    data: 'ProductSalePrice'
                },
                {
                    data: 'Discount'
                },
                 {
                    "data": null,
                    render: function(data) {

                      
                          return "<input type='text' value='"+
                                data.order_no +"' onkeyup='orderNoSave(" + data.id + ")' id='data_" + data.id + "' style='width:50px'>";
                        

                    }
                },
                {
                    "data": null,
                    render: function(data) {

                        if (data.best_selling == 0) {
                            return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="1" id="productbeststatusBtn" data-id="' +
                                data.id + '">Active</button>';
                        } else {
                            return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="0" id="productbeststatusBtn" data-id="' +
                                data.id + '" >Inactive</button>';
                        }


                    }
                },
                {
                    "data": null,
                    render: function(data) {

                        if (data.is_sub_product == 0) {
                            return '<button type="button" class="btn btn-success btn-sm btn-status" data-id="' +
                                data.id + '">Parent</button>';
                        } else {
                            if (data.is_single_page == 1) {
                                 return '<button type="button" class="btn btn-warning btn-sm btn-status" data-id="' +
                                data.id + '" >Landing page</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-status" data-id="' +
                                data.id + '" >Child</button>';
                            }
                            
                        }


                    }
                },
                {
                    "data": null,
                    render: function(data) {

                        if (data.frature == 0) {
                            return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="1" id="productfeaturstatusBtn" data-id="' +
                                data.id + '">Active</button>';
                        } else {
                            return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="0" id="productfeaturstatusBtn" data-id="' +
                                data.id + '" >Inactive</button>';
                        }


                    }
                },
                {
                    "data": null,
                    render: function(data) {

                        if (data.top_rated == 1) {
                            return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="0" id="productratedstatusBtn" data-id="' +
                                data.id + '">Active</button>';
                        } else {
                            return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="1" id="productratedstatusBtn" data-id="' +
                                data.id + '" >Inactive</button>';
                        }


                    }
                },
                {
                    "data": null,
                    render: function(data) {

                        if (data.status == 'Active') {
                            return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="Inactive" id="productstatusBtn" data-id="' +
                                data.id + '">Active</button>';
                        } else {
                            return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="Active" id="productstatusBtn" data-id="' +
                                data.id + '" >Inactive</button>';
                        }


                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ]
        });

        //add category

        $('#AddProduct').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                uploadUrl: '{{ route('admin.products.store') }}',
                processData: false,
                contentType: false,
                data: new FormData(this),

                success: function(data) {
                    $('#ProductName').val("");
                    $('#ProductSalePrice').val("");
                    $('#Discount').val("");
                    $('#ProductImage').val("");
                    $('#prevFile').html("src", '');
                    $('#PostImage').val("");
                    $('#prevFile').html("src", '');

                    swal({
                        title: "Success!",
                        icon: "success",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });
        
         //edit category
        $(document).on('click', '#editProductBtn', function() {
            
            
        
            let productId = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'products-edit-weight/' + productId ,

                success: function(data) {
                    
                    $('#weightEdit').html(data);
                  
                },
                error: function(error) {
                    console.log('error');
                }


            });
            
            
             $.ajax({
                type: 'GET',
                url: 'products-edit-page/' + productId ,

                success: function(data) {
                    
                    $('#edit_page_id_hidden').html(data);
                  
                },
                error: function(error) {
                    console.log('error');
                }


            });
        });         
            
        //      //edit category
        // $(document).on('click', '#editProductBtn', function() {
        //     let productId = $(this).data('id');

        //     $.ajax({
        //         type: 'GET',
        //         url: 'products-edit-category/' + productId ,

        //         success: function(data) {
                    
        //             $('#productCateEdit').html(data);
                  
        //         },
        //         error: function(error) {
        //             console.log('error');
        //         }


        //     });
        // });   
        
         
        
        
        
        //edit category
        $(document).on('click', '#editProductBtn', function() {
            let productId = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: 'products/' + productId + '/edit',

                success: function(data) {
                     
                  // ১. ডাটা যদি স্ট্রিং হিসেবে আসে (JSON), তবে পার্স করুন
                    let categories = [];
                    try {
                        categories = typeof data.category_id === 'string' 
                                     ? JSON.parse(data.category_id) 
                                     : data.category_id;
                    } catch (e) {
                        categories = [data.category_id]; // যদি সিঙ্গেল আইডি হয়
                    }
                    
                    // ২. Select2 এ ভ্যালু সেট করে রিফ্রেশ করুন
                    $('#editcategory_id').val(categories).trigger('change');
        
                    // =========================
                    // SUBCATEGORY (JSON → ARRAY)
                    // =========================
                    let subcategories = [];
                    if (data.subcategory_id) {
                        subcategories = JSON.parse(data.subcategory_id);
                    }
        
                    // 🔥 single entry point
                    loadEditSubcategories(subcategories);
    
               
                    // Data ta load korar por view te set kora
                    $('#edit_page_id_hidden').html(data);
        
                    // --- Color Auto-select Logic Start ---
                    // Prothome sob checkbox uncheck kore nicchi jate ager kono data na thake
                    $('input[name="color[]"]').prop('checked', false);
        
                    if (data.color) {
                        let selectedColors = [];
                        try {
                            // JSON string ke array te convert kora
                            selectedColors = typeof data.color === 'string' ? JSON.parse(data.color) : data.color;
                            
                            // Protiti color er jonno checkbox check kora
                            $.each(selectedColors, function(index, value) {
                                $('input[name="color[]"][value="' + value + '"]').prop('checked', true);
                            });
                        } catch (e) {
                            console.error("Color JSON parsing error:", e);
                        }
                    }
                    // --- Color Auto-select Logic End ---
        
                    // Size thakle seitao aki bhabe korte paren
                                    // সাইজ হ্যান্ডলিং
                if (data.size) {
                    // ১. প্রথমে সব চেকবক্স আনচেক করে নিন
                    $('input[name="size[]"]').prop('checked', false);
                
                    try {
                        // ২. ডাটা যদি স্ট্রিং হয় তবে পার্স করুন, না হলে সরাসরি ব্যবহার করুন
                        let selectedSizes = (typeof data.size === 'string') ? JSON.parse(data.size) : data.size;
                
                        // ৩. চেক করুন selectedSizes একটি অ্যারে কি না
                        if (Array.isArray(selectedSizes)) {
                            $.each(selectedSizes, function(index, value) {
                                // ভ্যালু অনুযায়ী টিক দিন
                                $('input[name="size[]"][value="' + value + '"]').prop('checked', true);
                            });
                        }
                    } catch (e) {
                        console.error("Parsing error in size:", e);
                    }
                } else {
                    // যদি ডাটা না থাকে তবে সব আনচেক করে দিন (নিরাপত্তার জন্য)
                    $('input[name="size[]"]').prop('checked', false);
                }
                    $('#EditProduct').find('#product_id').val(data
                        .id);
                    $('#EditProduct').find('#ProductName').val(data
                        .ProductName);
                    $('#EditProduct').find('#youtube_embade').val(data.youtube_embade);
                    $('#EditProduct').find('#EditProductSalePrice').val(data
                        .ProductSalePrice);
                    $('#EditProduct').find('#EditDiscount').val(data
                        .Discount);
                    $('#EditProduct').find('#EditProductRegularPrice').val(data
                        .ProductRegularPrice);
                    // $('#EditProduct').find('#editcategory_id').val(data
                    //     .category_id);
                    $('#EditProduct').find('#brand_id').val(data
                        .brand_id);
                        $('#EditProduct').find('#ProductSlug').val(data
                        .ProductSlug);
                        $('#EditProduct').find('#ProductSku').val(data
                        .ProductSku);
                    $('#EditProduct').find('#editProductBreaf').val(data
                        .ProductBreaf);
                    var isWeight = data
                        .is_weight;
                        $('#edit_is_weight').val(isWeight);
                        
                        
                       var is_single_page = data
                        .is_single_page;
                        $('#is_single_page').val(is_single_page);
                         var edit_sub_product = data
                        .is_sub_product;
                        $('#edit_sub_product').val(edit_sub_product);
                        
                    if(isWeight == 1) {
                        $('#edit_weight_id_hidden').show();
                    } else {
                        $('#edit_weight_id_hidden').hide();
                    }
                    $('#descriptionPro').html('');
                    
                    $('#descriptionPro').append(
                        `<label for="ProductDetails">Product Description <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="editProductDetails" name="ProductDetails" rows="5">` +
                        data.ProductDetails + `</textarea>

                        <script type="text/javascript">
                        $(document).ready(function() {
                         $('#editProductDetails').summernote({
                                                dialogsInBody: true,  
                                                height: 300,
                                                toolbar: [
                                                    ['style', ['style']],
                                                    ['font', ['bold', 'italic', 'underline', 'clear']],
                                                    ['fontname', ['fontname']],
                                                    ['fontsize', ['fontsize']],
                                                    ['color', ['color']],
                                                    ['para', ['ul', 'ol', 'paragraph']],
                                                    ['height', ['height']],
                                                    ['table', ['table']],
                                                    ['insert', ['link', 'picture', 'video']],
                                                    ['view', ['fullscreen', 'codeview', 'help']]
                                              ],
                                                popover: { image: [], link: [], air: [] }, // Prevent conflicts with Bootstrap modals
                                            });
                            
                            }); `);
                            
                    $('#previmg').html('');
                    if (data.ProductImage != "") {
                    $('#previmg').append(`
                            <div style="display: block; width: 100px;position: relative;"><img src="../` + data.ProductImage + `" alt="" style="height: 80px" />
                        <button class="remove" type="button" onclick="productImageRemove('` + data.id + `')" ><i class="fa fa-trash" ></id></button></div>`);
                    }
                    $('#EditProduct').attr('data-id', data.id);
                    
                    var is_single_page = $('#is_single_page').val();
                    if(is_single_page == 1) {
                        $('#edit_page_id_hidden').show();
                    } else {
                        $('#edit_page_id_hidden').hide();
                    }
                   
                    var postImages = JSON.parse(data.PostImage);
                    var postImage = "";
                    $('#viewprevFile').html('');


                    postImages.forEach((i, index) => {
                        postImage += `<div class="postImg" style="width:25%; float:left; box-sizing: border-box; padding:5px; text-align:center;">
                            <img src="../public/images/product/slider/${i}" alt="" style="border-radius: 10px; width:100%; display:block; margin-bottom:5px;">
                            
                            <!-- onclick-এ 'this' যোগ করা হয়েছে -->
                            <button class="remove_gallery" type="button" onclick="productSingleGalleryImageRemove('${data.id}', '${i}', ${index}, this)" style="background: red; color: white; border: none; padding: 5px; border-radius: 5px; cursor: pointer; width: 100%;">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>`;
                    });

                $('#viewprevFile').html(postImage);

                    $('#viewprevFile').html(postImage);


                },
                error: function(error) {
                    console.log('error');
                }


            });
        });

        $('#EditProduct').submit(function(e) {
            e.preventDefault();
            let productId = $('#product_id').val();

            $.ajax({
                type: 'POST',
                url: 'product/' + productId,
                processData: false,
                contentType: false,
                data: new FormData(this),

                success: function(data) {

                    if (data == 'error') {
                        toastr.error('Something wrong ! Please try again.');
                    }
                    $('#EditProduct').find('#product_id').val('');
                    $('#EditProduct').find('#ProductName').val('');
                    $('#EditProduct').find('#ProductSalePrice').val('');
                    $('#EditProduct').find('#Discount').val('');
                    $('#EditProduct').find('#editcategory_id').val('');

                    $('#EditProduct').find('#Discount').val('');
                    $('#EditProduct').find('#editProductBreaf').val('');
                    $('#descriptionPro').html('');
                    $('#previmg').html('');
                    $('#editsub_category_id').html('');
                    $('#EditProduct').find('#editsub_category_id').val('');
                    $('#viewprevFile').html('');
                    swal({
                        title: "Product updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }
            });
        });
        
        
        // delete category

        $(document).on('click', '#deleteProductBtn', function() {
            let categoryId = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: 'products/' + categoryId,
                            data: {
                                '_token': token
                            },
                            success: function(data) {
                                swal("Product has been deleted!", {
                                    icon: "success",
                                });
                                productinfo.ajax.reload();
                            },
                            error: function(error) {
                                console.log('error');
                            }

                        });


                    } else {
                        swal("Your data is safe!");
                    }
                });

        });
        
         $(document).on('click', '#copyBtnData', function() {
            let categoryId = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "Once copy, you will not be able to recover this !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: 'products-copy/' + categoryId,
                            data: {
                                '_token': token
                            },
                            success: function(data) {
                                swal("Product has been copy!", {
                                    icon: "success",
                                });
                                productinfo.ajax.reload();
                            },
                            error: function(error) {
                                console.log('error');
                            }

                        });


                    } else {
                        swal("Your data is safe!");
                    }
                });

        });

        // status update

        $(document).on('click', '#productstatusBtn', function() {
            let productId = $(this).data('id');
            let productStatus = $(this).data('status');

            $.ajax({
                type: 'PUT',
                url: 'product/status',
                data: {
                    product_id: productId,
                    status: productStatus,
                    '_token': token
                },

                success: function(data) {
                    swal({
                        title: "Status updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }

            });
        });

        $(document).on('click', '#productratedstatusBtn', function() {
            let productId = $(this).data('id');
            let productStatus = $(this).data('status');

            $.ajax({
                type: 'PUT',
                url: 'product/rated',
                data: {
                    product_id: productId,
                    top_rated: productStatus,
                    '_token': token
                },

                success: function(data) {
                    swal({
                        title: "Status updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }

            });
        });
        // feature
        $(document).on('click', '#productfeaturstatusBtn', function() {
            let productId = $(this).data('id');
            let productStatus = $(this).data('status');

            $.ajax({
                type: 'PUT',
                url: 'product/featur',
                data: {
                    product_id: productId,
                    frature: productStatus,
                    '_token': token
                },

                success: function(data) {
                    swal({
                        title: "Status updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }

            });
        });

        // best sell
        $(document).on('click', '#productbeststatusBtn', function() {
            let productId = $(this).data('id');
            let productStatus = $(this).data('status');

            $.ajax({
                type: 'PUT',
                url: 'product/best-selling',
                data: {
                    product_id: productId,
                    best: productStatus,
                    '_token': token
                },

                success: function(data) {
                    swal({
                        title: "Status updated !",
                        icon: "success",
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                    });
                    productinfo.ajax.reload();
                },
                error: function(error) {
                    console.log('error');
                }

            });
        });

    });

    
</script>
<script src="{{ asset('public/backend/rep/jquery.repeater.js') }}"></script>
    <script>
    $(document).ready(function () {
        'use strict';

     

        window.outerRepeater = $('.outer-repeater').repeater({
            isFirstItemUndeletable: true,
            //defaultValues: { 'text-input': '' },
            show: function () {
                console.log('outer show');
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                console.log('outer delete');
                $(this).slideUp(deleteElement);
            },
            repeaters: [{
                isFirstItemUndeletable: true,
                selector: '.inner-repeater',
                defaultValues: { 'inner-text-input': 'inner-default' },
                show: function () {
                    console.log('inner show');
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    console.log('inner delete');
                    $(this).slideUp(deleteElement);
                }
            }]
        });
    });
    </script>
<script type="text/javascript">
    function setsubcategory() {

    let categoryIds = $('#category_id').val();

    let dropdown = $('#sub_category_id');

    // 🔥 reset select2 properly
    dropdown.html(null).trigger('change');

    if (!categoryIds || categoryIds.length === 0) {
        dropdown.html('<option value="">Select Subcategory</option>').trigger('change');
        return;
    }

    $.ajax({
        type: 'GET',
        url: 'get/subcategory/' + categoryIds.join(','),

        success: function(res) {

            let data = res.data || [];

            if (!Array.isArray(data)) {
                data = [data];
            }

            let options = '<option value="">Select Subcategory</option>';

            if (data.length === 0) {
                dropdown.html(options).trigger('change');
                return;
            }

            data.forEach(function(item) {
                options += `
                    <option value="${item.id}">
                        ${item.sub_category_name}
                    </option>
                `;
            });

            dropdown.html(options);

            // 🔥 IMPORTANT: refresh select2
            dropdown.trigger('change.select2');
        },

        error: function(error) {
            console.log(error);
        }
    });
}
    function loadEditSubcategories(selectedSubIds = []) {

    let categoryIds = $('#editcategory_id').val();

    if (!categoryIds || categoryIds.length === 0) {
        $('#editsub_category_id').html('<option value="">Select Subcategory</option>');
        return;
    }

    $.ajax({
        type: 'GET',
        url: 'get/subcategory/' + categoryIds.join(','),

        success: function (res) {

            let dropdown = $('#editsub_category_id');
            dropdown.html('');

            let subcats = res.data || [];

            if (!Array.isArray(subcats)) {
                subcats = [subcats];
            }

            let options = '';

            subcats.forEach(item => {

                let selected = selectedSubIds.includes(String(item.id)) ? 'selected' : '';

                options += `
                    <option value="${item.id}" ${selected}>
                        ${item.sub_category_name}
                    </option>
                `;
            });

            dropdown.html(options).trigger('change');
        },

        error: function (err) {
            console.log(err);
        }
    });
}
    function editsetsubcategory(selectedSubIds = []) {

        let categoryIds = $('#editcategory_id').val(); // 🔹 array আসবে
    
        if (!categoryIds || categoryIds.length === 0) {
            $('#editsub_category_id').html('<option value="">Select Sub-Category</option>');
            return;
        }
    
        // 🔹 array → comma string
        let ids = categoryIds.join(',');
    
        $.ajax({
            type: 'GET',
            url: 'get/subcategory/' + ids,
    
            success: function(res) {
    
                let dropdown = $('#editsub_category_id');
                dropdown.html('');
    
                if (!res.status || !res.data || res.data.length === 0) {
                    dropdown.append('<option value="">No Subcategory Found</option>');
                    return;
                }
    
                let subcats = res.data;
    
                // 🔹 single → array
                if (!Array.isArray(subcats)) {
                    subcats = [subcats];
                }
    
                subcats.forEach(function(item) {
    
                    // 🔹 multiple selected check
                    let selected = selectedSubIds.includes(item.id) ? 'selected' : '';
    
                    dropdown.append(`
                        <option value="${item.id}" ${selected}>
                            ${item.sub_category_name}
                        </option>
                    `);
                });
    
                // 🔥 select2 refresh (important)
                dropdown.trigger('change');
            },
    
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('prevImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    var galleryloadFile = function(event) {
        // document.getElementById("previmg").style.display = "none";
        var output = document.getElementById('galleryprevImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var editloadFile = function(event) {
        $('#previmg').html('');
        var output = document.getElementById('editprevImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    var editgalleryloadFile = function(event) {
        // document.getElementById("previmg").style.display = "none";
        var output = document.getElementById('editgalleryprevImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>


<script>

  $(document).ready(function() {
    var windowHeight = $(window).height();
    $("#editmainProduct").css("height", windowHeight-0+"px"); 
    // $("#editmainProduct").attr("style", "height: "+windowHeight - 50+"px !important;");
    console.log("Window loaded. Height: " + windowHeight + "px");
});
    var PostImages = [];

    function prevPost_Img() {
        var PostImage = document.getElementById('PostImage').files;

        for (i = 0; i < PostImage.length; i++) {
            if (check_duplicate(PostImage[i].name)) {
                PostImages.push({
                    "name": PostImage[i].name,
                    "url": URL.createObjectURL(PostImage[i]),
                    "file": PostImage[i],
                });
            } else {
                alert(PostImage[i].name + 'is already added to your list');
            }
        }

        document.getElementById("prevFile").innerHTML = PostImage_show();

    }

    function check_duplicate(name) {
        var PostImage = true;
        if (PostImages.length > 0) {
            for (e = 0; e < PostImages.length; e++) {
                if (PostImages[e].name == name) {
                    PostImage = false;
                    break;
                }
            }
        }
        return PostImage;
    }

    function PostImage_show() {
        var PostImage = "";
        PostImages.forEach((i) => {
            PostImage += `<div class="postImg" style="width:25%;float:left;position:relative;">
                                <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                <span onclick="removeSelectedPostImage(` + PostImages.indexOf(i) + `)" style="position: absolute;right: 0;cursor: pointer;font-size: 31px;color: red;margin-top: -8px;margin-right: 8px;">&times</span>
                            </div>`;
        })
        return PostImage;
    }

    function removeSelectedPostImage(e) {
        PostImages.splice(e, 1);
        document.getElementById("prevFile").innerHTML = PostImage_show();
    }

    var editPostImages = [];

    function editprevPost_Img() {
        // $('#viewprevFile').html('');
        // alert();
        var editPostImage = document.getElementById('editPostImage').files;

        for (i = 0; i < editPostImage.length; i++) {
            if (check_duplicate(editPostImage[i].name)) {
                editPostImages.push({
                    "name": editPostImage[i].name,
                    "url": URL.createObjectURL(editPostImage[i]),
                    "file": editPostImage[i],
                });
            } else {
                alert(editPostImage[i].name + 'is already added to your list');
            }
        }

        document.getElementById("editprevFile").innerHTML = editPostImage_show();

    }

    function check_duplicate(name) {
        var editPostImage = true;
        if (editPostImages.length > 0) {
            for (e = 0; e < editPostImages.length; e++) {
                if (editPostImages[e].name == name) {
                    editPostImage = false;
                    break;
                }
            }
        }
        return editPostImage;
    }

    function editPostImage_show() {
        var editPostImage = "";
        editPostImages.forEach((i) => {
            editPostImage += `<div class="postImg" style="width:25%;float:left;position:relative;">
                                <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                <span onclick="removeSelectededitPostImage(` + editPostImages.indexOf(i) + `)" style="position: absolute;right: 0;cursor: pointer;font-size: 31px;color: red;margin-top: -8px;margin-right: 8px;">&times</span>
                            </div>`;
        })
        return editPostImage;
    }

    function removeSelectededitPostImage(e) {
        editPostImages.splice(e, 1);
        document.getElementById("editprevFile").innerHTML = editPostImage_show();
    }
</script>
<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

@endsection
