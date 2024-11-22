@php
    $corder_model = new \App\Models\COrder;
@endphp
<div class="__item_json mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if ($corder_model::canHandle() && $index > 0)
        <span class="d-flex color_red smooth fs-15 __remove_object_json_item"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    @php
        $where_product = [];
        $warehouse_type = @$dataItem['warehouse_type'] ?? @$warehouse_type;
        if (!empty($warehouse_type)) {
            $where_product['warehouse_type'] = $warehouse_type;
        }
        dump($item_type);
        if (!empty($item_type)) {
            $where_product['type'] = $item_type == $corder_model::SELL ? \TDConst::INTERNAL_PRODUCT : \TDConst::ORDER_PRODUCT;
        }
        $field_obj = [
            'name' => 'id',
            'note' => 'Chọn thành phẩm',
            'attr' => [
                "required" => 1, 
                "inject_class" => "__select_product_sell"
            ],
            'type' => 'linking',
            'value' => !empty($value['product']) ? $value['product'] : '',
            'other_data' => [
                "config" => [ "search"=> 1],
                "data" => [
                    "table" => 'product_warehouses',
                    'where' => $where_product 
                ]
            ]
        ];
        $field_name = [
            'name' => 'name',
            'type' => 'text',
            'note' => 'Tên sản phẩm',
            'attr' => ['inject_class' => '__selling_input_product_name'],
        ];
        $field_qty = [
            'name' => 'qty',
            'type' => 'text',
            'note' => 'Số lượng',
            'attr' => [
                'type_input' => 'price', 
                'inject_class' => '__selling_input_count_item __selling_qty_input_item'
            ],
        ];
        $field_price = [
            'name' => 'price',
            'type' => 'text',
            'note' => 'Đơn giá',
            'attr' => [
                'type_input' => 'price', 
                'inject_class' => '__selling_input_count_item __selling_price_input_item'
            ],
        ];
        $field_total = [
            'name' => 'total',
            'type' => 'text',
            'note' => 'Thành tiền',
            'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__selling_total_item_input']
        ];
        $field_object_type = [
            $field_obj,
            $field_name,
            $field_qty,
            $field_price,
            $field_total
        ];
    @endphp
    @foreach ($field_object_type as $item)
        @php
            $jname = $item['name'];
            $item['value'] = @$value[$jname]; 
            $item['name'] = 'object['.$index.']['.$jname.']';
            $item['dataItem'] = @$value;
            $item['min_label'] = 175;
            if (empty($item['attr']['readonly'])) {
                $item['attr']['readonly'] = \App\Models\COrder::canHandle() ? 0 : 1;
            }
        @endphp
        @include('view_update.view', $item) 
    @endforeach   
</div>