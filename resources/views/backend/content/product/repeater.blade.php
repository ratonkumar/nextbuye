<div class="card p-3 mb-4">
    <h5>{{ $label }}</h5>
    
    @if(isset($imageField) && $imageField)
        <div class="mb-3">
            <label>Left Side Image</label>
            <input type="file" name="content[left_image]" class="form-control">
        </div>
        <div class="row">
            <div class="col-md-6"><label>Sub Title</label><input type="text" name="content[sub_title]" class="form-control" value="{{ $content['sub_title'] ?? '' }}"></div>
            <div class="col-md-6"><label>Main Title</label><input type="text" name="content[title]" class="form-control" value="{{ $content['title'] ?? '' }}"></div>
        </div>
    @endif

    <div id="{{ $id }}-repeater" class="mt-3">
        <label>Features List</label>
        @foreach(($data ?? [['title'=>'', 'subtitle'=>'']]) as $index => $item)
            <div class="row mb-2 feature-row">
                <div class="col-md-5"><input type="text" name="content[{{$id}}][{{$index}}][title]" class="form-control" placeholder="Title" value="{{ $item['title'] }}"></div>
                <div class="col-md-6"><input type="text" name="content[{{$id}}][{{$index}}][subtitle]" class="form-control" placeholder="Description" value="{{ $item['subtitle'] }}"></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger remove-row">-</button></div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addRow('{{ $id }}')">Add Feature</button>
</div>