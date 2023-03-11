@php
    $select_config = !empty($other_data['config']) ? $other_data['config'] : [];
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = getOptionDataField($select_data);
@endphp
<select class="multiple_select" multiple="multiple" data-note="{{ $note }}">
    @if (!empty($list_options))
        @foreach ($list_options as $option)
            <option value="{{ @$option->id }}">{{ $option->name }}</option>
        @endforeach
    @endif  
</select>