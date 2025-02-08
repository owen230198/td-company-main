@php
    $represent_field = \App\Models\Represent::getFieldUpdateLinking();
@endphp
<div class="item_data_linking mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if (\GroupUser::isAdmin() || \GroupUser::isSale())
        <span class="d-flex color_red smooth remove_parent_element_button remove_data_linking_button" 
        {{ !empty($value['id']) ? ' data-id='.$value['id'].' data-table=represents' : '' }}>
            <i class="fa fa-times" aria-hidden="true"></i>
        </span> 
    @endif
    @foreach ($represent_field as $item)
        @php
            $key_name = $item['name'];
            $item['value'] = @$value[$key_name]; 
            $item['name'] = 'represent['.$index.']['.$key_name.']';
            $item['dataItem'] = @$value;
            $item['min_label'] = 150;
            $not_update = !\GroupUser::isAdmin() && (!empty($value) && !isDataOwn($value));
            if ($not_update) {
                $item['attr']['disable_field'] = true;
                if (in_array($key_name, ['phone', 'telephone', 'email'])) {
                    $item['value'] = !empty($value) ? '**********' : '';
                }
            }
        @endphp
        @if (!empty($value) && !$not_update)
            <input type="hidden" name="represent[{{ $index }}][id]" value="{{ $value['id'] }}" class="form-control">
        @endif
        @include('view_update.view', $item)   
    @endforeach                
</div>