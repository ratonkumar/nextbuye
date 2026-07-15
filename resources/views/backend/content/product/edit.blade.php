@extends('backend.master')

@section('title') {{ env('APP_NAME') }} - Landing Page Management @endsection

@section('maincontent')
<div class="container-fluid pt-4 px-4">
    <h2>Landing Page Management</h2>

    @php
        $allSections = [
            'highlights_section' => ['val1', 'label1', 'val2', 'label2', 'val3', 'label3', 'val4', 'label4'],
            'problem_section' => [
                'story_title', 'title', 'problem_desc', 
                'card1_title', 'card1_desc', 'card2_title', 'card2_desc', 
                'card3_title', 'card3_desc', 'card4_title', 'card4_desc',
                'footer_text', 'footer_highlight'
            ],
            'comparison_section' => ['comparison_title', 'comparison_left', 'comparison_right'],
            'product_features' => [
                'features_left_image',      // ইমেজ আপলোডের জন্য
                'sub_title',       // সেকশনের সাব-টাইটেল
                'title',           // মেইন টাইটেল
                'features_list'    // রিপিটার ডাটা (title ও subtitle এর সমন্বয়ে)
            ],
            'about_section' => ['title', 'description', 'image_url'],
            'service_section' => ['title', 'service_list'],
            'question_section' => ['question', 'answer'],
            'video_section' => ['video_title', 'video_link'],
            'cart_section' => ['cart_title', 'shipping_info']
        ];
    @endphp

    <div class="row">
        @foreach($allSections as $section_key => $fields)
            @php
                $sectionData = $sections->where('section_key', $section_key)->first();
                $content = $sectionData ? json_decode($sectionData->content, true) : array_fill_keys($fields, '');
            @endphp

            <div class="card mb-4" id="section_{{ $section_key }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-capitalize">{{ str_replace('_', ' ', $section_key) }}</h5>
                    <button class="btn btn-sm {{ ($sectionData && $sectionData->is_active) ? 'btn-success' : 'btn-danger' }}" 
                            onclick="toggleSection('{{ $section_key }}')">
                        {{ ($sectionData && $sectionData->is_active) ? 'ON' : 'OFF' }}
                    </button>
                </div>
                <div class="card-body">
                    <form class="update-form" data-key="{{ $section_key }}">
                        @csrf
                        <input type="hidden" value="{{ $productID ?? 0 }}" name="productID">
                        
                        <div class="row">
                            @php
                                // আপনার সব রিপিটার ফিল্ডের নাম এখানে যোগ করুন
                                $repeaterFields = ['features_list', 'benefits_list', 'steps_list', 'requirements_list'];
                            @endphp
                            @foreach($fields as $field)
                            <div class="col-md-6 mb-3"> 
                                <label class="small fw-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                
                                @if(in_array($field, ['problem_desc', 'card1_desc', 'card2_desc', 'card3_desc', 'card4_desc']))
                                    <textarea name="content[{{ $field }}]" class="form-control">{{ $content[$field] ?? '' }}</textarea>
                                    
                                @elseif(in_array($field, ['comparison_title', 'comparison_left', 'comparison_right', 'footer_text']))
                                    <textarea name="content[{{ $field }}]" class="form-control summernote">{{ $content[$field] ?? '' }}</textarea>
                                @elseif(in_array($field, ['features_left_image', 'image_3', 'image_4', 'image_5', 'image_6', 'image_7']))
                                    <div class="mb-3">
                                        <label class="small fw-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                        
                                        {{-- ইনপুট ফিল্ডে একটি ক্লাস এবং আইডি যোগ করলাম --}}
                                        <input type="file" name="content[{{ $field }}]" class="form-control image-input" data-target="{{ $field }}-preview">
                                        
                                        {{-- প্রিভিউ দেখানোর জন্য একটি ডিভ --}}
                                        <div class="mt-2" id="{{ $field }}-preview">
                                            @if(!empty($content[$field]))
                                                <img src="{{ asset($content[$field]) }}" width="100" class="img-thumbnail">
                                                <small class="d-block text-muted">Current Image</small>
                                            @endif
                                        </div>
                                    </div>
                                {{-- ৪. ডাইনামিক রিপিটার --}}
                                {{-- লুপের ভেতরে কন্ডিশনটি এভাবে আপডেট করুন --}}
                                @elseif(in_array($field, $repeaterFields))
                                    <div class="card p-3 mb-4">
                                        <h5>{{ ucfirst(str_replace('_', ' ', $field)) }}</h5>
                                        <div id="{{ $field }}-repeater" class="mt-3">
                                            @php
                                                $items = (isset($content[$field]) && is_array($content[$field])) ? $content[$field] : [['title'=>'', 'subtitle'=>'']];
                                            @endphp
                                            
                                            @foreach($items as $index => $item)
                                                <div class="row mb-2 feature-row">
                                                    <div class="col-md-5">
                                                        <input type="text" name="content[{{ $field }}][{{$index}}][title]" class="form-control" value="{{ $item['title'] ?? '' }}" placeholder="Title">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="content[{{ $field }}][{{$index}}][subtitle]" class="form-control" value="{{ $item['subtitle'] ?? '' }}" placeholder="Description">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-danger remove-row">-</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addRow('{{ $field }}')">Add New Item</button>
                                    </div>

                                {{-- ৫. সাধারণ ইনপুট --}}
                                    
                                @else
                                    <input type="text" name="content[{{ $field }}]" value="{{ $content[$field] ?? '' }}" class="form-control">
                                @endif
                            </div>
                        @endforeach
                           
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save {{ ucfirst(str_replace('_', ' ', $section_key)) }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- কালারসহ সিডিএন লিঙ্ক -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.image-input').change(function() {
            let input = this;
            let targetId = $(input).data('target');
            
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                
                reader.onload = function(e) {
                    // যদি আগে কোনো ছবি থাকে, সেটি সরিয়ে নতুনটি দেখাবে
                    $('#' + targetId).html(`
                        <img src="${e.target.result}" width="100" class="img-thumbnail">
                        <small class="d-block text-muted">New Preview</small>
                    `);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
<script>
    function addRow(id) {
        let container = $('#' + id + '-repeater');
        let index = container.find('.feature-row').length;
        let html = `
            <div class="row mb-2 feature-row">
                <div class="col-md-5"><input type="text" name="content[${id}][${index}][title]" class="form-control" placeholder="Title"></div>
                <div class="col-md-6"><input type="text" name="content[${id}][${index}][subtitle]" class="form-control" placeholder="Description"></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger remove-row">-</button></div>
            </div>`;
        container.append(html);
    }

    $(document).on('click', '.remove-row', function() {
        $(this).closest('.feature-row').remove();
    });
</script>
<script>
    // নির্দিষ্ট ফিল্ডগুলোকে এডিটরে কনভার্ট করার ফাংশন
    $(document).ready(function() {
        // 'summernote' ক্লাসযুক্ত সব টেক্সট এরিয়াতে এডিটর চালু হবে
        $('.summernote').summernote({
            height: 200, // এডিটরের উচ্চতা
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']], // ফন্ট সাইজের জন্য
                ['color', ['color']],       // কালারের জন্য
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']]
            ]
        });
    });
    function initEditors() {
        let editors = ['problem_desc', 'card1_desc', 'card2_desc', 'card3_desc', 'card4_desc', 'footer_text'];
        
        editors.forEach(function(fieldName) {
            ClassicEditor
                .create(document.querySelector('textarea[name="content[' + fieldName + ']"]'))
                .catch(error => { console.error(error); });
        });
    }

    // পেজ লোড হওয়ার পর এডিটর চালু হবে
    $(document).ready(function() {
        initEditors();
    });
</script>
<script>
    // Update Logic
    $('.update-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let key = form.data('key');
        
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
                Swal.fire({ icon: 'success', title: 'Success!', text: 'Updated successfully.', timer: 1500 });
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
            }
        });
    });

    // Toggle Logic
    function toggleSection(key) {
        let productID = $('input[name="productID"]').first().val();

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
                product_id: productID
            },
            success: function(res) { 
                Swal.fire({ icon: 'success', title: 'Status Updated!', showConfirmButton: false, timer: 1000 })
                     .then(() => { location.reload(); });
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Failed!', text: 'Could not update status.' });
            }
        });
    }
</script>
@endsection