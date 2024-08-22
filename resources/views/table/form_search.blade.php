<div class="base_table_form_search">
    <form action="{{ @$link_search ?? asset('search-table/'.$tableItem['name']) }}" method="GET" class="mb-0" id="form-search">
        @if (!empty($param_default))
            <input type="hidden" name="default_data" value='{{ $param_default }}'>
        @endif
        @if (!empty($nosidebar))
            <input type="hidden" name="nosidebar" value = '1'>
        @endif
        @if (!empty($ext_params))
            @foreach ($ext_params as $key => $value)
                <input type="hidden" name="{{ $key }}" value = '{{ $value }}'>    
            @endforeach
        @endif
        @php
            $data_search = @$data_search ?? [];
        @endphp
        @foreach ($field_searchs as $field)
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
    </form>
</div>