@php
    $type = !empty($type) ? $type : 'text';
@endphp
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_180 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
        @if (@$attr['required'] == 1)
            <span class="fs-15 mr-1">*</span>
        @endif
        {{ $note }} 
    </label>
    @include('view_update.'.$type)
</div>