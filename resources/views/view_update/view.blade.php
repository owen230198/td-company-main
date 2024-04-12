@php
    $type = !empty($type) ? $type : 'text';
@endphp
@if ($type == 'group')
    @include('view_update.'.$type)
@else
    <div class="form-group d-flex mb-2 align-items-center">
        <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1 base_label_input">
            @if (@$attr['required'] == 1)
                <span class="fs-15 mr-1">*</span>
            @endif
            {{ $note }} 
        </label>
        @include('view_update.'.$type)
    </div>
@endif