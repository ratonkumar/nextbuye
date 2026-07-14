@extends('backend.master')

@section('maincontent')
@section('title') {{ env('APP_NAME') }}- Landing Page Management @endsection

<div class="container-fluid pt-4 px-4">
    <h2>Landing Page Management</h2>
    
    @php
        $allSections = [
            'highlights_section' => ['val1', 'label1', 'val2', 'label2', 'val3', 'label3', 'val4', 'label4'],
            'hero_section' => ['title', 'subtitle', 'button_text'],
            'about_section' => ['title', 'description', 'image_url'],
            'service_section' => ['title', 'service_list'],
            'problem_section' => ['title', 'problem_desc'],
            'difference_section' => ['title', 'comparison'],
            'question_section' => ['question', 'answer'],
            'video_section' => ['video_title', 'video_link'],
            'cart_section' => ['cart_title', 'shipping_info']
        ];
    @endphp

    <div class="row">
        @foreach($allSections as $key => $fields)
            @php
                $sectionData = $sections->get($key);
                $content = $sectionData ? json_decode($sectionData->content, true) : array_fill_keys($fields, '');
            @endphp

            <div class="card mb-4" id="section_{{ $key }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-capitalize">{{ str_replace('_', ' ', $key) }}</h5>
                    <button class="btn btn-sm {{ ($sectionData && $sectionData->is_active) ? 'btn-success' : 'btn-danger' }}" 
                            onclick="toggleSection('{{ $key }}')">
                        {{ ($sectionData && $sectionData->is_active) ? 'ON' : 'OFF' }}
                    </button>
                </div>
                <div class="card-body">
                    <form class="update-form" data-key="{{ $key }}">
                        @csrf
                        <div class="row">
                            @foreach($fields as $field)
                                <div class="col-md-3 mb-3">
                                    <label class="small fw-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    <input type="text" name="content[{{ $field }}]" value="{{ $content[$field] ?? '' }}" class="form-control">
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save {{ ucfirst(str_replace('_', ' ', $key)) }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Update Logic
    $('.update-form').on('submit', function(e) {
        e.preventDefault();
        let key = $(this).data('key');
        $.ajax({
            url: '/admin/settings/update/' + key,
            method: 'POST',
            data: $(this).serialize(),
            success: function(res) { 
                alert('Updated Successfully!'); 
            },
            error: function() {
                alert('Something went wrong!');
            }
        });
    });

    // Toggle Logic
    function toggleSection(key) {
        $.ajax({
            url: '/admin/settings/toggle/' + key,
            method: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res) { 
                location.reload(); 
            }
        });
    }
</script>
@endsection