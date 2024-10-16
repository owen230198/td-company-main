@php
    $field_warehouse_type = [
        'name' => 'object['.$index.'][warehouse_type]',
        'note' => 'Chọn Kho thành phẩm',
        'attr' => [
            "required" => 1, 
            "inject_class" => "__select_warehouse_type",
            "readonly" => \GroupUser::isAdmin() || \GroupUser::isSale() ? 0 : 1,
        ],
        'type' => 'linking',
        'value' => !empty($value['warehouse_type']) ? $value['warehouse_type'] : '',
        'other_data' => [
            "config" => [ "search"=> 1],
            "data" => [
                'table' => 'supply_extends',
                'where' => ['type' => 'warehouse_type']
            ]
        ],
        'min_label' => 175
    ];
@endphp
<div class="__item_json mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if ((\GroupUser::isAdmin() || \GroupUser::isSale()) && $index > 0)
        <span class="d-flex color_red smooth fs-15 __remove_object_json_item"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @include('view_update.view', $field_warehouse_type) 
    <div class="__ajax_field_sell_pro">
        @if (!empty($value))
            @include('product_warehouses.filed_json_item')
        @endif  
    </div>       
</div>