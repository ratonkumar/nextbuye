<!-- উপরের আইকন সেকশন -->
@php
    // নির্দিষ্ট প্রোডাক্টের 'highlights_section' ডাটা নিয়ে আসা
    $highlightSection = \App\Models\LandingPageSetting::where('section_key', 'highlights_section')
                        ->where('product_id', $productdetails->id)
                        ->where('is_active', 1)
                        ->first();

    $highlights = $highlightSection ? json_decode($highlightSection->content, true) : null;
@endphp

@if($highlights)
<div class="container-fluid" style="background: #1a1a1a; padding: 40px 0; color: #fff;">
    <div class="container">
        <div class="row text-center">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-md-3">
                    <h2 style="color: #ff5722;">{{ $highlights['val'.$i] ?? '' }}</h2>
                    <p>{{ $highlights['label'.$i] ?? '' }}</p>
                </div>
            @endfor
        </div>
    </div>
</div>
@endif