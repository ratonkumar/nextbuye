@extends('backend.master')

@section('title') {{ env('APP_NAME') }} - Landing Page Management @endsection

@section('maincontent')
<div class="container-fluid pt-4 px-4">
    <h2>Landing Page Management</h2>
    
    @php
        $allSections = [
            'hero_section' => [
                'title' => ['type' => 'text', 'label' => 'Main Title', 'col' => '6'],
                'subtitle' => ['type' => 'textarea', 'label' => 'Sub Title', 'col' => '6'],
                'button_text' => ['type' => 'text', 'label' => 'Button Text', 'col' => '6'],
                'status' => ['type' => 'radio', 'label' => 'Status', 'col' => '6', 'options' => ['active' => 'Active', 'inactive' => 'Inactive']]
            ],
            'problem_section' => [
                'story_title' => ['type' => 'text', 'label' => 'Story Title', 'col' => '4'],
                'problem_desc' => ['type' => 'textarea', 'label' => 'Description', 'col' => '4'],
                'layout_style' => ['type' => 'select', 'label' => 'Layout', 'col' => '4', 'options' => ['grid' => 'Grid', 'list' => 'List']]
            ]
        ];
    @endphp

    <div class="row">
        @foreach($allSections as $key => $fields)
            @php
                $sectionData = $sections->get($key);
                $content = $sectionData ? json_decode($sectionData->content, true) : [];
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
                        <input type="hidden" value="{{ $productID ?? 0 }}" name="productID">
                        <div class="row">
                            @foreach($fields as $fieldName => $fieldData)
                                <div class="col-md-{{ $fieldData['col'] ?? '3' }} mb-3">
                                    <label class="small fw-bold">{{ $fieldData['label'] }}</label>
                                    
                                    @if($fieldData['type'] == 'text')
                                        <input type="text" name="content[{{ $fieldName }}]" value="{{ $content[$fieldName] ?? '' }}" class="form-control">
                                    
                                    @elseif($fieldData['type'] == 'textarea')
                                        <textarea name="content[{{ $fieldName }}]" class="form-control" rows="2">{{ $content[$fieldName] ?? '' }}</textarea>
                                    
                                    @elseif($fieldData['type'] == 'select')
                                        <select name="content[{{ $fieldName }}]" class="form-control">
                                            @foreach($fieldData['options'] as $val => $lbl)
                                                <option value="{{ $val }}" {{ ($content[$fieldName] ?? '') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                            @endforeach
                                        </select>

                                    @elseif($fieldData['type'] == 'radio')
                                        <div class="mt-2">
                                            @foreach($fieldData['options'] as $val => $lbl)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="content[{{ $fieldName }}]" value="{{ $val }}" {{ ($content[$fieldName] ?? '') == $val ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $lbl }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Save {{ str_replace('_', ' ', $key) }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Scripts (Keep your existing AJAX logic here as it is perfect) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // আপনার বিদ্যমান AJAX আপডেট এবং টগল ফাংশনগুলো এখানে বসান...
</script>
@endsection