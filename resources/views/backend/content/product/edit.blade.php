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
            'hero_section' => ['title', 'subtitle', 'button_text'],
            'about_section' => ['title', 'description', 'image_url'],
            'service_section' => ['title', 'service_list'],
          
            'difference_section' => ['title', 'comparison'],
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
                            @foreach($fields as $field)
                                <div class="col-md-6 mb-3"> <label class="small fw-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    
                                    @if(in_array($field, ['problem_desc', 'card1_desc', 'card2_desc','card3_desc','card4_desc', 'footer_text']))
                                        <textarea name="content[{{ $field }}]" class="form-control">{{ $content[$field] ?? '' }}</textarea>
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
<!-- CKEditor 5 Full Build CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/decoupled-document/ckeditor.js"></script>
<script>
    // নির্দিষ্ট ফিল্ডগুলোকে এডিটরে কনভার্ট করার ফাংশন
    function initEditors() {
    let editors = ['problem_desc', 'card1_desc', 'card2_desc', 'card3_desc', 'card4_desc', 'footer_text'];
        
        editors.forEach(function(fieldName) {
            let textarea = document.querySelector('textarea[name="content[' + fieldName + ']"]');
            
            if (textarea) {
                ClassicEditor
                    .create(textarea, {
                        toolbar: {
                            items: [
                                'heading', '|', 'bold', 'italic', '|',
                                'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                                'bulletedList', 'numberedList', '|', 'undo', 'redo'
                            ]
                        },
                        fontSize: {
                            options: [ 9, 11, 13, 'default', 17, 19, 21 ]
                        }
                    })
                    .then(editor => {
                        // এটি নিশ্চিত করবে যে আগের টেক্সটগুলো এডিটরে লোড হবে
                        editor.setData(textarea.value); 
                    })
                    .catch(error => { console.error(error); });
            }
        });
    }

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