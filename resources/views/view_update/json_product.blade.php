@php
    $arr_value = !empty($value) ? json_decode($value, true) : [];
@endphp
<div class="__json_data_module p-2 radius_5 box_shadow_3 form-control length_input">
    <div class="__list_item_json">
        @if (count($arr_value) > 0)
            @foreach ($arr_value as $key => $product_value)
                @include('product_warehouses.json_item', [
                    'index' => $key, 
                    'value' => $product_value,
                    'item_type' => @$dataItem->type
                ])
            @endforeach 
        @endif
    </div>
    @if (\App\Models\COrder::canHandle())
    <div class="text-center">
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_item_json_button" data-table="product_warehouses">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm thành phẩm
        </button>
    </div>
    @endif
    
</div>