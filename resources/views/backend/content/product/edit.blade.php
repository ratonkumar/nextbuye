@extends('backend.master')

@section('maincontent')
@section('title') {{ env('APP_NAME') }}- Landing Page Management @endsection

<div class="container-fluid pt-4 px-4">
    <h2>Landing Page Management</h2>

   
    @php
        $allSections = [
            'highlights_section' => ['val1', 'label1', 'val2', 'label2', 'val3', 'label3', 'val4', 'label4'],
            'problem_section' => [
                'story_title', 
                'title', 
                'problem_desc', 
                'card1_title', 'card1_desc',
                'card2_title', 'card2_desc',
                'card3_title', 'card3_desc',
                'card4_title', 'card4_desc',
                'footer_text', 'footer_highlight'
            ],
            'hero_section' => ['title', 'subtitle', 'button_text'],
            'about_section' => ['title', 'description', 'image_url'],
            'service_section' => ['title', 'service_list'],
            // 'problem_section' => ['title', 'problem_desc'],
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
                         <input type="hidden" value="{{ $productID ?? 0 }}" name="productID" id="productID">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Update Logic
    $('.update-form').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let key = form.data('key');
        
        // Loadding Start
        Swal.fire({
            title: 'Updating...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        $.ajax({
            url: '/admin/settings/update/' + key,
            method: 'POST',
            data: form.serialize(),
            success: function(res) { 
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Section updated successfully.',
                    timer: 1500
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON?.message || 'Something went wrong, please try again.'
                });
            }
        });
    });

    // Toggle Logic
    function toggleSection(key) {
        let productID = $('#productID').val(); // ইনপুট থেকে আইডি নেওয়া হচ্ছে

        Swal.fire({
            title: 'Processing...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        $.ajax({
            url: '/admin/settings/toggle/' + key,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productID // প্রোডাক্ট আইডি পাঠানো হচ্ছে
            },
            success: function(res) { 
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated!',
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    location.reload();
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: 'Could not update status.'
                });
            }
        });
    }
</script>
@endsection