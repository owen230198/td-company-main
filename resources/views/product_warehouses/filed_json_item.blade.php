@foreach ($field_object_type as $item)
    @php
        $jname = $item['name'];
        $item['value'] = @$value[$jname]; 
        $item['name'] = 'object['.$index.']['.$jname.']';
        $item['dataItem'] = @$value;
        $item['min_label'] = 175;
    @endphp
    @include('view_update.view', $item) 
@endforeach   