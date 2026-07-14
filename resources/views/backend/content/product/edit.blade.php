@extends('backend.master')

@section('maincontent')
@section('title')
    {{ env('APP_NAME') }} - Landing Page Management
@endsection

<div class="container-fluid pt-4 px-4">
    <div class="row">
        <h2>Landing Page Management</h2>
        
        {{-- আপনার যে সেকশনগুলো প্রয়োজন, সেগুলোর একটি অ্যারে এখানে রাখুন --}}
        @php
            $definedSections = ['hero_section', 'about_section', 'service_section'];
        @endphp

        @foreach($definedSections as $key)
            @php
                // ডাটাবেস থেকে ডাটা খুঁজুন
                $sectionData = $sections->where('key', $key)->first();
                $content = $sectionData ? json_decode($sectionData->content, true) : ['title' => '', 'subtitle' => ''];
            @endphp

            <div class="card mb-4" id="section_{{ $key }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ ucfirst(str_replace('_', ' ', $key)) }}</h5>
                    <button class="btn btn-sm {{ ($sectionData && $sectionData->is_active) ? 'btn-success' : 'btn-danger' }}" 
                            onclick="toggleSection('{{ $key }}')">
                        {{ ($sectionData && $sectionData->is_active) ? 'ON' : 'OFF' }}
                    </button>
                </div>
                <div class="card-body">
                    <form class="update-form" data-key="{{ $key }}">
                        @csrf
                        <div class="row">
                            {{-- এখানে আপনার প্রয়োজন অনুযায়ী ফিল্ডগুলো যোগ করুন --}}
                            <div class="col-md-6 mb-3">
                                <label>Title</label>
                                <input type="text" name="content[title]" value="{{ $content['title'] ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Subtitle</label>
                                <input type="text" name="content[subtitle]" value="{{ $content['subtitle'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // আপডেট করার AJAX
    $('.update-form').on('submit', function(e) {
        e.preventDefault();
        let key = $(this).data('key');
        let formData = $(this).serialize();

        $.ajax({
            url: '/admin/settings/update/' + key,
            method: 'POST',
            data: formData,
            success: function(res) { 
                alert('Updated Successfully!');
                location.reload(); 
            },
            error: function() { alert('Something went wrong!'); }
        });
    });

    // টগল করার AJAX
    function toggleSection(key) {
        $.ajax({
            url: '/admin/settings/toggle/' + key,
            method: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res) { location.reload(); }
        });
    }
</script>
@endsection