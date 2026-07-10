@for($i=0; $i<count($weightInfo); $i++)

<div data-repeater-item class="outer">
    <div class="row">
        <div class="col-4">
           <input type="text" name="weight" placeholder="Weight here" value="{{ $weightInfo[$i]->weight ?? '' }}" class="form-control outer"/>
        </div>
        <div class="col-3">
           <input type="text"  name="regular_price" placeholder="Regular Price" value="{{  $weightInfo[$i]->regular_price ?? '' }}"  class="form-control outer"/>
       </div>
         <div class="col-3">
           <input type="text"  name="sale_price" placeholder="Sale Price" value="{{  $weightInfo[$i]->sale_price ?? '' }}" class="form-control outer"/>
       </div>
       <div class="col-2">
            <input data-repeater-delete type="button" value="Delete" class="btn btn-danger outer"/>
        </div>
    </div>
</div>
@endfor