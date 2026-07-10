 <label for="ProductCategory" style="width: 100%;">Categories <span
            class="text-danger">*</span></label>
    <select class="form-control" id="editcategory_id"
        style="background: black;" name="category_id[]"
        onchange="editsetsubcategory()" multiple>
        <option>Select Category</option>
        @forelse ($categories as $category)
            <option value="{{ $category->id }}" @foreach($product as  $productID) @if($category->id == $productID->category_id) selected @endif @endforeach>
                {{ $category->category_name }}
            </option>
        @empty
        @endforelse
    </select>
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
       
    });
  
  
</script>