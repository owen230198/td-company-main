<div class="__json_field_module {{ @$attr['inject_class'] }}" data-json = '{{ json_encode($other_data, JSON_FORCE_OBJECT) }}' data-name={{ $name }}>
    <div class="__list_item_field">
        @if (!empty($value))
            @foreach ($value as $key => $value_item)
                @include('json_fields.json_item', ['value' => $value_item, 'jindex' => $key])   
            @endforeach
        @endif
    </div>
    <div class="__json_field_button_module text-center">
        <button type="button" class="main_button color_white bg_green border_green radius_5 fs-10 sooth __json_field_button_add">
            Thêm {{ $note }}
        </button>
    </div>
</div>
