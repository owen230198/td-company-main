@php
    $represent_field = \App\Models\Represent::getFieldUpdateLinking();
@endphp
<div class="item_data_linking mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if (\GroupUser::isAdmin() || \GroupUser::isSale())
        <span class="d-flex color_red smooth remove_parent_element_button remove_data_linking_button"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @foreach ($represent_field as $item)
        @php
            $key_name = $item['name'];
            $item['value'] = @$value[$key_name]; 
            $item['name'] = 'represent['.$index.']['.$key_name.']';
            $item['dataItem'] = @$value;
            $item['min_label'] = 115;
            if (!\GroupUser::isAdmin() && (!empty($value) && !isDataOwn($value))) {
                $item['attr']['disable_field'] = true;
                if (in_array($key_name, ['phone', 'telephone', 'email'])) {
                    $item['value'] = !empty($value) ? '**********' : '';
                }
            }
        @endphp
        @if (!empty($value))
            <input type="hidden" name="represent[{{ $index }}][id]" value="{{ $value['id'] }}">
        @endif
        @include('view_update.view', $item)   
    @endforeach                
</div>