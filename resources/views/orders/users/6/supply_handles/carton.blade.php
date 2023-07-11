@extends('orders.users.6.supply_handles.supplies')
@section('process')
@php
    $key_supp = \TDConst::CARTON;
    $carton_divide = \TDConst::CARTON_SIZE_DIVIDE;
    $carton_compen_percent = (float) getDataConfig('QuoteConfig', 'CARTON_COMPEN_PERCENT');
    $carton_plus = \TDConst::CARTON_SIZE_PLUS;
@endphp
@include('quotes.products.supplies.title_config', ['divide' => $carton_divide, 'name' => $key_supp])

@include('quotes.products.supplies.quantity_config', ['compen_percent' => $carton_compen_percent])

@include('quotes.products.supplies.size_config', ['plus' => $carton_plus, 'divide' => $carton_divide])

@include('quotes.products.supplies.select_supply_type')

<div class="supply_process_handle">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư theo yêu cầu</span>
    </h3>
    <input type="hidden" name="id" value="{{ @$supply_obj->id }}">
    <input type="hidden" name="table" value="{{ @$table }}">
    <div class="plan_handle_supply_module">
        <div class="module_hanle_supply_plan quantity_paper_module plan_handle_elevate_module" data-percent = {{ $carton_compen_percent }}>
            @php
                $c_name = 'c_supply';
                $field_handles = [
                    [
                        'name' => $c_name.'[size_type]',
                        'type' => 'linking',
                        'note' => 'Chọn khổ vật tư trong kho',
                        'attr' => ['inject_class' => 'plan_select_size_type'],
                        'value' => '',
                        'other_data' => [
                            'config' => ['search' => 1], 
                            'data' => [
                                'table' => 'supply_warehouses', 
                                'where' => [
                                    'type' => $key_supp, 
                                    'supp_type' => @$supply_size['supply_type'],
                                    'supp_price' => @$supply_size['supply_price'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'name' => $c_name.'[product_qty]',
                        'note' => 'SL sản phẩm',
                        'attr' => ['inject_class' => 'pro_qty_input', 'type_input' => 'number', 'readonly' => 1],
                        'value' => @$supply_obj->product_qty,
                    ],
                    [
                        'name' => $c_name.'[nqty]',
                        'note' => 'SL sản phẩm/tờ to',
                        'attr' => ['inject_class' => 'pro_nqty_input paper_qty_modul_input', 'type_input' => 'number'],
                        'value' => 0,
                    ],
                    [
                        'name' => $c_name.'[supp_qty]',
                        'note' => 'SL vật tư cần xuất + '.$carton_compen_percent.'%',
                        'attr' => ['inject_class' => 'paper_qty_input plan_input_supp_qty input_elevate_change', 'type_input' => 'number', 'readonly' => 1],
                        'value' => 0,
                    ],
                    [
                        'name' => 'elevate[num]',
                        'note' => 'Nhập số lượt bế',
                        'attr' => ['inject_class' => 'plan_input_elevate input_elevate_change', 'type_input' => 'number'],
                        'value' => 0,
                    ],
                    [
                        'name' => 'elevate[total]',
                        'note' => 'Nhập số lượt bế',
                        'attr' => ['inject_class' => 'plan_input_total_elevate', 'type_input' => 'number', 'readonly' => 1],
                        'value' => 0,
                    ],
                ];
                $wh_name = 'over_supply';
                $field_warehouses = [
                    [
                        'name' => $wh_name.'[length]',
                        'note' => 'Khổ chiều dài',
                        'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
                        'value' => 0,
                    ],
                    [
                        'name' => $wh_name.'[width]',
                        'note' => 'Khổ chiều rộng',
                        'attr' => ['type_input' => 'number', 'inject_class' => 'plan_input_warehouse_size'],
                        'value' => 0,
                    ],
                    [
                        'name' => $wh_name.'[qty]',
                        'note' => 'SL nhập kho',
                        'attr' => ['inject_class' => 'plan_input_warehouse_qty', 'type_input' => 'number', 'readonly' => 1],
                        'value' => 0,
                    ]
                ]      
            @endphp
            @foreach ($field_handles as $field_handle)
                @include('view_update.view', $field_handle)     
            @endforeach
        </div>
        <div class="enter_warehouse_module">
            <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
                <span>Nhập kho băng lề</span>
            </h3>
            @foreach ($field_warehouses as $field_warehouse)
                @include('view_update.view', $field_warehouse)     
            @endforeach
        </div>
    </div>
</div>
@endsection