@extends('backend.master')

@section('maincontent')
@section('title')
    {{ env('APP_NAME') }}- Products
@endsection
<div class="container py-5">
    <h2>Landing Page Management - Choplet</h2>
    
    {{-- প্রতিটি সেকশনের জন্য একটি কার্ড --}}
    @foreach($sections as $key => $section)
    <div class="card mb-4" id="section_{{ $key }}">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ ucfirst(str_replace('_', ' ', $key)) }}</h5>
            <button class="btn btn-sm {{ $section->is_active ? 'btn-success' : 'btn-danger' }}" 
                    onclick="toggleSection('{{ $key }}')">
                {{ $section->is_active ? 'ON' : 'OFF' }}
            </button>
        </div>
        <div class="card-body">
            <form class="update-form" data-key="{{ $key }}">
                @csrf
                <div class="row">
                    @foreach($section->content as $field => $value)
                    <div class="col-md-6 mb-3">
                        <label>{{ ucfirst($field) }}</label>
                        <input type="text" name="{{ $field }}" value="{{ $value }}" class="form-control">
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
            </form>
        </div>
    </div>
    @endforeach
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
            success: function(res) { alert('Updated Successfully!'); }
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