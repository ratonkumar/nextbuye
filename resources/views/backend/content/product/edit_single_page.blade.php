                   <div class="col-12">
                        <label for="single_page">Add Sub Product <span  class="text-danger">*</span></label>
                        <br>
                        <select class="form-control select2" id="sub_product_id" name="sub_product_id[]" multiple  >
                            <option value="0"> select Product</option>
                            @if(!empty($singleProductList))
                            @foreach ($singleProductList as $singleProduct)
                                <option value="{{ $singleProduct->id }}" @if(!empty($subProductID)) @foreach($subProductID as  $productID) @if($productID == $singleProduct->id) selected @endif @endforeach @endif> {{ $singleProduct->ProductName }}
                            @endforeach
                            @endif
                        </select>
                    </div>
                 <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="single_page">Product Header Title</label>
                        <textarea class="form-control" id="subTitleHEader" name="subTitleHEader" rows="5"> {!! $product->subTitleHEader !!}</textarea>
                      
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="single_page">Sub Title</label>
                        <textarea class="form-control" id="subTitle1" name="subTitle1" rows="5"> {!! $product->subTitle1 !!}</textarea>
                      
                    </div>
                </div>
                <div class="col-12">
                    <label for="ProductDetailsss">Product Description <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="ProductDetails1" name="ProductDetails1" rows="5">{!! $product->ProductDetails1 !!}</textarea>
                </div>
                
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="single_page">Sub Title(1)</label>
                        <textarea class="form-control" id="subTitle2" name="subTitle2" rows="5"> {!! $product->subTitle2 !!}</textarea>
                      
                    </div>
                </div>
                <div class="col-12">
                    <label for="ProductDetailsss">Product Description(1) <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="ProductDetails2" name="ProductDetails2" rows="5">{!! $product->ProductDetails2 !!}</textarea>
                </div>
                
                  <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="single_page">Sub Title(2)</label>
                        <textarea class="form-control" id="subTitle3" name="subTitle3" rows="5"> {!! $product->subTitle3 !!}</textarea>
                       
                    </div>
                </div>
                <div class="col-12">
                    <label for="ProductDetailsss">Product Description(2) <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="ProductDetails3" name="ProductDetails3" rows="5"> {!! $product->ProductDetails3 !!}</textarea>
                </div>
                
                <script type="text/javascript">
                    $(document).ready(function() {
                    $('#subTitleHEader').summernote({
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
                        $('#ProductDetails1').summernote({
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
                        
                         $('#ProductDetails2').summernote({
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
                        
                         $('#ProductDetails3').summernote({
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
                     
                      $('#subTitle1').summernote({
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
                        
                         $('#subTitle2').summernote({
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
                        
                        
                           $('#subTitle3').summernote({
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
                

<!-- Include Select2 JavaScript -->
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script>
    $(document).ready(function() {
        $('#sub_product_id').select2({
          placeholder: 'Select an option',
          allowClear: true
        });
       
    });
  
  
</script>