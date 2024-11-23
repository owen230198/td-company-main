@php
    $jindex = !empty($jindex) ? $jindex : 0;
    $other_data = !empty($other_data) ? $other_data : [];
@endphp
<div class="__json_field_item position-relative row row-5" data-index="{{ $jindex }}">
    @if ($jindex > 0)
        <span class="d-flex color_red smooth fs-15 __remove_object_json_item __json_field_remove_btn"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @foreach ($other_data as $field_json)
        @php
            $jname = $field_json['name'];
            $field_json['name'] = $name.'['.$jindex.']['.$jname.']';
            $col = !empty($field_json['attr']['width']) ? $field_json['attr']['width'] : 12;
            $field_json['value'] = !empty($value[$jname]) ? $value[$jname] : '';
        @endphp
        <div class="col-{{ $col }}">
            @include('view_update.view', $field_json)
        </div>
    @endforeach   
</div>