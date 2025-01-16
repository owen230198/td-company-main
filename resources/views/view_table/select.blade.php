@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = !empty($select_data['options']) ? $select_data['options'] : [];
    $label  = '';
@endphp
@if (!empty($other_data['config']['multiple']))
    @php
        $values = !empty($value) ? json_decode($value, true) : []; 
    @endphp
    @if (!empty($values))
        @foreach ($values as $key_label => $value_item)
            @php
                if ($key_label == 0){
                    $label .= $list_options[$value_item];
                }else{
                    $label .= ' | '.$list_options[$value_item]; 
                }
            @endphp
        @endforeach
        <p class="color_main linking_table">
            {{ $label }}
        </p>
    @endif
@else
    @if (!empty($other_data['config']['direct_show']))
        <p class="color_main radius_5 mb-0 text-center linking_table">
            {{ $value }}
        </p>
    @else
        <p class="color_main radius_5 mb-0 {{ empty($history_view) ? 'linking_table' : '' }}">
            {{ !empty($list_options[$value]) ? $list_options[$value] : '---' }}
        </p>
    @endif
@endif

