@php
    $compen_percent = (float) getDataConfig('QuoteConfig', strtoupper($key_supp).'_COMPEN_PERCENT');
    $c_name = 'c_supply['.$index.']';
    $where_size_type = !empty($where_size_supp) ? $where_size_supp : 
    [
        'type' => $key_supp, 
        'supp_type' => @$supply_size['supply_type'],
        'supp_price' => @$supply_size['supply_price'],
        'status' => 'imported'
    ];

    $field_select =  [
        'name' => $c_name.'[command][size_type]',
        'type' => 'linking',
        'note' => 'Chọn vật tư trong kho',
        'attr' => ['inject_class' => 'plan_select_size_type __select_in_warehouse'],
        'value' => '',
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => [
                'table' => @$table_type ?? 'supply_warehouses', 
                'where' => $where_size_type
            ]
        ]
    ];

    $field_handles = [
        [
            'name' => '',
            'type' => 'text',
            'note' => 'Số lượng sản phẩm',
            'attr' => ['inject_class' => 'pro_qty_input', 'type_input' => 'number', 'readonly' => 1],
            'value' => @$supply_obj->product_qty,
        ],
        [
            'name' => $c_name.'[command][nqty]',
            'type' => 'text',
            'note' => 'Số sản phẩm/tờ to',
            'attr' => ['inject_class' => 'pro_nqty_input supp_qty_modul_input', 'type_input' => 'number'],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[command][qty]',
            'type' => 'text',
            'note' => 'Số vật tư cần xuất + '.$compen_percent.'%',
            'attr' => ['inject_class' => 'total_supp_qty_input plan_input_supp_qty input_elevate_change', 'type_input' => 'number', 'readonly' => 1],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[elevate][num]',
            'type' => 'text',
            'note' => 'Số bát/tờ to',
            'attr' => ['inject_class' => 'plan_input_elevate input_elevate_change', 'type_input' => 'number'],
            'value' => 0,
        ],
        [
            'name' => $c_name.'[elevate][total]',
            'type' => 'text',
            'note' => 'Tổng số lượt bế',
            'attr' => ['inject_class' => 'plan_input_total_elevate', 'type_input' => 'number', 'readonly' => 1],
            'value' => 0,
        ]
    ]; 
@endphp
<div class="module_hanle_supply_plan quantity_supp_module plan_handle_elevate_module __handle_supply_item {{ $index > 0 ? 'mt-3 pt-3 border_top_eb' : '' }}" data-percent = {{ $compen_percent }}>
    <div class="row">
        <div class="col-6">
            @include('view_update.view', $field_select) 
            <div class="__handle_supply_detail_ajax" style="display: none">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
                    <p class="font_bold __inhouse"></p>
                </div>
                @foreach ($field_handles as $field_handle)
                    @include('view_update.view', $field_handle)     
                @endforeach   
                @include('orders.users.6.supply_handles.view_handles.after_select')
            </div>
        </div>
        <div class="col-6 border_left_eb __over_supply" style="display:none">
            @include('orders.users.6.supply_handles.view_handles.over_supplies.item')      
        </div>  
    </div>
</div>