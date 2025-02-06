@php
    $type = !empty($type) ? $type : 'text';
@endphp
@if ($type == 'group' || !empty($attr['nolabel']))
    @include('view_update.'.$type, ['attr_parent' => @$attr])
@else
    <div class="form-group d-lg-flex mb-2">
        <label 
        class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1 base_label_input" 
        style="{{ !empty($min_label) ? 'min-width:'.$min_label.'px' : '' }}">
            @if (@$attr['required'] == 1)
                <span class="fs-15 mr-1">*</span>
            @endif
            {{ $note }} 
        </label>
        @include('view_update.'.$type)
    </div>
@endif