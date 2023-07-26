@php
    $group_class = @$other_data['group_class'];
@endphp
<div class="group_class_view {{ $group_class }}">
    @foreach ($child as $field_child)
        @php
            $arr = processArrField($field_child);
            $arr['value'] = @$dataItem[$field_child['name']];
        @endphp
        @include('view_update.view', $arr)
    @endforeach   
</div>