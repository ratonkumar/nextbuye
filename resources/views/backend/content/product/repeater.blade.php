{{-- বর্তমান লুপটি বদলে নিচের মতো লিখুন --}}
@php
    // যদি ডাটা স্ট্রিং হিসেবে আসে বা খালি থাকে, তবে তাকে জোরপূর্বক অ্যারেতে রূপান্তর করুন
    $items = $data ?? [];
    if (is_string($items)) {
        $items = json_decode($items, true) ?? [];
    }
@endphp

@foreach($items as $index => $item)
    <div class="row mb-2 feature-row">
        <div class="col-md-5">
            <input type="text" name="content[features_list][{{$index}}][title]" class="form-control" value="{{ is_array($item) ? ($item['title'] ?? '') : '' }}">
        </div>
        <div class="col-md-6">
            <input type="text" name="content[features_list][{{$index}}][subtitle]" class="form-control" value="{{ is_array($item) ? ($item['subtitle'] ?? '') : '' }}">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-row">-</button>
        </div>
    </div>
@endforeach