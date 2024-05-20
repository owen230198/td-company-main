@foreach ($fields as $field)
    @if (@$field['type'] == 'group')
        @php
            $type = !empty($field['type']) ? $field['type'] : 'text';
            $field['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
            $field['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
        @endphp
        @include('view_search.'.$type, $field)    
    @else
        @include('view_search.view', ['field' => $field])
    @endif
@endforeach