@php
    $fieldChildLinkings = \App\Models\NDetailTable::getByAction($table, 'get_other');
@endphp
<div class="item_child_linking mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if (\GroupUser::isAdmin())
        <span class="d-flex color_red smooth remove_parent_element_button remove_data_linking_button" 
        {{ !empty($value['id']) ? ' data-id='.$value['id'].' data-table='.$table : '' }}>
            <i class="fa fa-times" aria-hidden="true"></i>
        </span> 
    @endif
    @foreach ($fieldChildLinkings as $item)
        @php
            $item = processArrField($item);
            $c_name = $item['name'];
            $item['value'] = @$value[$c_name]; 
            $item['name'] = $key_name.'['.$index.']['.$c_name.']';
            $item['dataItem'] = @$value;
            $item['min_label'] = 150;
        @endphp
        @if (!empty($value['id']))
            <input type="hidden" name="{{ $key_name.'['.$index.'][id]' }}" value="{{ $value['id'] }}" class="form-control">
        @endif
        @include('view_update.view', $item)   
    @endforeach                
</div>