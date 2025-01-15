@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = !empty($select_data['options']) ? $select_data['options'] : [];
@endphp
@if (!empty($other_data['config']['multiple']))
    @php
        $values = !empty($value) ? json_decode($value, true) : []; 
    @endphp
    @if (!empty($values))
        @foreach ($values as $value_item)
            <p class="color_main radius_5 mb-1 pb-1 border_bot_eb text-center linking_table">
                {{ @$list_options[$value_item] }}
            </p>
        @endforeach
    @endif
@else
    @if (!empty($other_data['config']['direct_show']))
        <p class="color_main radius_5 mb-0 text-center linking_table">
            {{ $value }}
        </p>
    @else
        <p class="color_main radius_5 mb-0 {{ empty($history_view) ? 'linking_table' : '' }}">
            {{ !empty($list_options[$value]) ? $list_options[$value] : 'Không xác định' }}
        </p>
    @endif
@endif

