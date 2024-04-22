@php
    $type = !empty($field['type']) ? $field['type'] : 'text';
    $field['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
    $field['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
@endphp
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
        {{ $field['note'] }} 
    </label>
    @include('view_search.'.$type, $field)
</div>