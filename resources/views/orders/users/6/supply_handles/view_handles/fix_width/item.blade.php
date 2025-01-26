@php
    $compen_percent = (float) getDataConfig('QuoteConfig', strtoupper($key_supp).'_COMPEN_PERCENT');
    $c_name = 'c_supply['.$key_supp.']['.$index.']';
    $where_size_type = !empty($where_size_supp) ? $where_size_supp : 
    [
        'type' => $key_supp, 
        'target' => @$supp_price,
        'qtv' => @$qtv,
        'status' => 'imported',
        'except_value' => '{"field" :"id","value":"'.@$except_value.'"}'
    ];

    $field_select =  [
        'name' => $c_name.'[command][size_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư trong kho',
        'attr' => ['inject_class' => '__select_in_warehouse length_input'],
        'value' => '',
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => [
                'table' => @$table_type ?? 'supply_warehouses', 
                'where' => $where_size_type
            ]
        ]
    ];
    $product_qty_field = [
            'name' => '',
            'type' => 'text',
            'note' => 'SL sản phẩm',
            'attr' => [
                'inject_class' => 'fixProQtyInput __fix_width_supp_handle_input', 
                'type_input' => 'number',
                'readonly' => 1
            ],
            'value' => @$supply_obj->product_qty,
    ];

    $field_handles = [
        [
            'name' => '',
            'type' => 'text',
            'note' => 'Kích thước xả',
            'attr' => [
                'inject_class' => 'fixSizeTakeOutInput __fix_width_supp_handle_input', 
                'type_input' => 'number'
            ],
            'value' => 0,
        ],
        [
            'name' => '',
            'type' => 'text',
            'note' => 'Số bát SP/Tờ xả',
            'attr' => [
                'inject_class' => 'fixNqtytInput __fix_width_supp_handle_input', 
                'type_input' => 'number',
            ],
            'value' => 0,
        ],
        [
            'name' => '',
            'type' => 'text',
            'note' => 'Tổng số tờ cần xả + '.$compen_percent.'%',
            'attr' => [
                'inject_class' => 'fixQtyInput', 
                'type_input' => 'number', 
                'readonly' => 1
            ],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[config][cut_width]',
            'type' => 'text',
            'note' => 'Xén SP chiều 1',
            'attr' => [
                'inject_class' => 'fixCutWidthInput __fix_width_supp_handle_input', 
                'type_input' => 'number', 
            ],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[config][cut_length]',
            'type' => 'text',
            'note' => 'Xén SP chiều 2',
            'attr' => [
                'inject_class' => 'fixCutLengthInput __fix_width_supp_handle_input', 
                'type_input' => 'number', 
            ],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[config][total]',
            'type' => 'text',
            'note' => 'Tổng số vật tư cho đơn',
            'attr' => [
                'inject_class' => 'fixTotalSupplyInput', 
                'type_input' => 'number', 
                'readonly' => 1
            ],
            'value' => 0,
        ]
    ]; 
@endphp
<div class="module_hanle_supply_plan quantity_fix_width_supp_module position-relative __handle_supply_item {{ $index > 0 ? 'mt-3 pt-3 border_top_eb' : '' }}" data-percent = {{ $compen_percent }} data-take = "0">
    @if ($index > 0)
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    @endif
    <div class="row">
        <div class="col-6">
            @include('view_update.view', $field_select) 
            @include('view_update.view', $product_qty_field)
            <div class="__handle_supply_detail_ajax" style="display: none">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Kích thước rộng : </label>
                    <p class="font_bold __sizeFixWidth"></p>
                </div>
                @foreach ($field_handles as $field_handle)
                    @include('view_update.view', $field_handle)     
                @endforeach   
                @include('orders.users.6.supply_handles.view_handles.after_select')
            </div>
        </div>
        <div class="col-6 border_left_eb __over_supply" style="display:none">
            @include('orders.users.6.supply_handles.view_handles.over_supplies.item', ['key_supp' => $key_supp])      
        </div>  
    </div>
</div>