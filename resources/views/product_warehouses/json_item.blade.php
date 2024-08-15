@php
    $field_object_type = \App\Models\COrder::getFeildProductJson(@$value);
@endphp
<div class="__item_json mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if ((\GroupUser::isAdmin() || \GroupUser::isSale()) && $index > 0)
        <span class="d-flex color_red smooth fs-15 __remove_object_json_item"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
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
</div>