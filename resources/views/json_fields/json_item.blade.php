@php
    $jindex = !empty($jindex) ? $jindex : 0;
@endphp
<div class="__json_field_item {{ @$attr['inject_class'] }} row row-5" data-index="{{ $jindex }}">
    @foreach ($other_data as $field_json)
        @php
            $jname = $field_json['name'];
            $field_json['name'] = $name.'['.$jindex.']['.$jname.']';
            $col = !empty($field_json['attr']['width']) ? $field_json['attr']['width'] : 12
        @endphp
        <div class="col-{{ $col }}">
            @include('view_update.view', $field_json)
        </div>
    @endforeach   
</div>