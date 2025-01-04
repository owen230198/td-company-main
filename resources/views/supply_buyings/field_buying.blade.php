@php
    $supplyBuying = new \App\Models\SupplyBuying;
    $group_name = 'supply['.$index.']';
@endphp
<div class="__data_supply_buying_conf" data-cate={{ $supp_type }}>
    @foreach ($fields as $field)
        @php
            $name = $field['name'];
            $field['name'] = $group_name.'['.$name.']';
            $field['min_label'] = 175;
            $field['value'] = @$group_value[$name];
        @endphp
        @include('view_update.view', $field)      
    @endforeach
    @if ($supplyBuying::hasSizeSupply($supp_type))
       @php
            $field_sizes = [
                [
                    'name' => $group_name.'[length]',
                    'note' => 'Dài (cm)',
                    'attr' => ['inject_class' => '__buying_length __buying_change_input', 'type_input' => 'number']
                ],
                [
                    'name' => $group_name.'[width]',
                    'note' => 'Rộng (cm)',
                    'attr' => ['inject_class' => '__buying_width __buying_change_input', 'type_input' => 'number']
                ],
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
            'name' => $group_name.'[price]',
            'type' => 'text',
            'note' => 'Số lượng',
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
            'min_label' =>  175,
            'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__buying_total_input']
        ];
    @endphp
    @include('view_update.view', $field_qty)
    @include('supply_buyings.provider_price_field',[
        'provider_name' => $group_name.'[sugg_provider]',
        'price_name' => $group_name.'[sugg_price]',
        'readonly' => 1,
        'note' => 'NCC đề xuất'
    ])
    @include('supply_buyings.provider_price_field',[
        'provider_name' => $group_name.'[provider]',
        'price_name' => $group_name.'[price]',
        'readonly' => 0,
        'note' => 'NCC thực tế'
    ])
    @include('view_update.view', $field_total)
</div>
