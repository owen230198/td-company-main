@php
    $type = !empty($type) ? $type : 'text';
@endphp
<div class="form-group d-flex mb-3 pb-3">
    <label class="mb-0 min_150 fs-13 text-capitalize text-right mr-3">
        @if (@$attr['required'] == 1)
            <span class="fs-15 mr-1">*</span>
        @endif
        {{ $note }} 
    </label>
    @include('view_update.'.$type)
</div>