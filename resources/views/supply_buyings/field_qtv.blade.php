
@php
    $supplyBuying = new \App\Models\SupplyBuying;
    $group_name = 'supply['.$index.']';
    $is_other_target = $value['target'] == \StatusConst::OTHER;
    if (!$is_other_target) {
        $field_qtv = [
            'name' => $group_name.'[qtv]',
            'note' => 'Định lượng',
            'min_label' => 175,
            'value' => @$value['qtv'],
            'attr' => [
                'inject_class' => '__qtv_select __qtv_buying_field __buying_change_input',
                'inject_attr' => 'data-price_purchase='.getFieldDataById('price_purchase', 'supply_prices', @$value['qtv']),
            ],
            'type' => 'linking',
            'other_data' => [
                'config' => [
                    'search' => 1
                ],
                'data' => [
                    'table' =>'supply_prices',
                    'where' => ['type' => $supp_type, 'supply_id' => $value['target']]
                ]
            ]
        ];    
    }else{
        $field_qtv = [
            'name' => $group_name.'[qtv]',
            'note' => 'Định lượng',
            'min_label' => 175,
            'value' => @$value['qtv'],
            'attr' => [
                'inject_class' => '__qtv_input __qtv_buying_field __buying_change_input',
                'inject_attr' => 'data-price_purchase='.@$value['qtv'],
                'type_input' => 'number'
            ],
            'type' => 'text'
        ];
        $field_name = [
            'name' => $group_name.'[name]',
            'type' => 'text',
            'note' => 'Tên vật tư',
            'value' => @$value['name'],
            'min_label' => 175
        ];
    }
@endphp
@if (!empty($field_name))
    @include('view_update.view', $field_name)
@endif
@include('view_update.view', $field_qtv)
@if ($supplyBuying::hasSizeSupply($supp_type))
    @php
        $field_sizes = [[
                'name' => $group_name.'[width]',
                'note' => 'Rộng - Ngang (cm)',
                'type' => 'text',
                'value' => @$value['width'],
                'attr' => ['inject_class' => '__buying_width __buying_change_input', 'type_input' => 'number']
            ],
            [
                'name' => $group_name.'[length]',
                'note' => 'Dài (cm)',
                'type' => 'text',
                'value' => @$value['length'],
                'attr' => ['inject_class' => '__buying_length __buying_change_input', 'type_input' => 'number']
            ]
        ] 
    @endphp
    @foreach ($field_sizes as $field_size)
        @php
            $field_size['min_label'] = 175;
        @endphp
        @include('view_update.view', $field_size)
    @endforeach
@endif
@php
    $field_qty = [
        'name' => $group_name.'[qty]',
        'type' => 'text',
        'note' => 'Số lượng',
        'value' => @$value['qty'],
        'min_label' =>  175,
        'attr' => [
            'type_input' => 'number', 
            'inject_class' => '__buying_qty_input __buying_change_input'
        ],
    ];
    $field_total = [
        'name' => $group_name.'[total]',
        'type' => 'text',
        'note' => 'Thành tiền',
        'value' => @$value['total'],
        'min_label' =>  175,
        'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__buying_total_input']
    ];
@endphp
@include('view_update.view', $field_qty)
@if ($is_other_target)
    @php
        $field_price = [
            'name' => $group_name.'[price]',
            'type' => 'text',
            'note' => 'Đơn giá',
            'value' => @$value['price'],
            'min_label' => 175,
            'attr' => [
                'type_input' => 'price',
                'inject_class' => '__buying_price_input __buying_change_input'
            ]
        ];
    @endphp
    @include('view_update.view', $field_price)
@else
    @include('supply_buyings.provider_price_field',[
        'provider_name' => $group_name.'[sugg_provider]',
        'price_name' => $group_name.'[sugg_price]',
        'readonly' => 1,
        'note' => 'NCC đề xuất',
        'value' => ['provider' => @$value['sugg_provider'], 'price' => @$value['sugg_price']],
        'origin' => @$value['origin'],
    ])
    @include('supply_buyings.provider_price_field',[
        'provider_name' => $group_name.'[provider]',
        'price_name' => $group_name.'[price]',
        'readonly' => 0,
        'note' => 'NCC thực tế',
        'value' => ['provider' => @$value['provider'], 'price' => @$value['price']],
        'origin' => @$value['origin'],
    ])
@endif
@include('view_update.view', $field_total)
@if ($supplyBuying::hasSizeSupply($supp_type))
    @php
        $field_sizes = [[
                'name' => $group_name.'[lenth_qty]',
                'note' => 'Số m chiều dài',
                'type' => 'text',
                'value' => @$value['lenth_qty'],
                'attr' => ['inject_class' => '__buying_lenth_qty __buying_change_input', 'type_input' => 'number', 'readonly' => 1]
            ],
            [
                'name' => $group_name.'[weight]',
                'note' => 'số kg khối lượng',
                'type' => 'text',
                'value' => @$value['weight'],
                'attr' => ['inject_class' => '__buying_weight __buying_change_input', 'type_input' => 'number', 'readonly' => 1]
            ]
        ] 
    @endphp
    @foreach ($field_sizes as $field_size)
        @php
            $field_size['min_label'] = 175;
        @endphp
        @include('view_update.view', $field_size)
    @endforeach
@endif