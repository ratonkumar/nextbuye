@php
  $productComparison = \App\Models\LandingPageSetting::where('section_key', 'product_comparison_table')
    ->where('product_id', $productdetails->id)
    ->where('is_active', 1)
    ->first();  
    $data = $productComparison ? json_decode($productComparison->content, true) : null;
@endphp

@if($data)
<section style="max-width: 940px; margin: 0px auto; padding: 80px 20px 20px">
   
        {!! $data['comparison_title'] !!}
    <p style="text-align: center; font-size: 16.5px; color: rgb(107, 100, 90); max-width: 560px; margin: 0px auto 36px; line-height: 1.75;">
        {!! $data['comparison_description'] !!}
    </p>

    <div style="display: flex; flex-wrap: wrap; gap: 18px; align-items: stretch; justify-content: center">
        
        <!-- Left Column (Generic) -->
        <div style="flex: 1 1 300px; max-width: 430px; background: rgb(247, 242, 234); border: 1px solid rgb(232, 224, 212); border-radius: 24px; padding: 26px 24px;">
            {!! $data['comparison_left'] !!}
        </div>

        <!-- Right Column (Choplet) -->
        <div style="flex: 1 1 300px; max-width: 430px; background: rgb(255, 255, 255); border: 2px solid rgb(240, 83, 43); border-radius: 24px; padding: 26px 24px; box-shadow: rgba(240, 83, 43, 0.55) 0px 26px 50px -30px; position: relative;">
             {!! $data['comparison_right'] !!}
        </div>
    </div>

    <!-- Bottom Text -->
    <div style="max-width: 700px; margin: 36px auto 0px; text-align: center">
       {!! $data['comparison_bottom'] !!}
    </div>
</section>
@endif