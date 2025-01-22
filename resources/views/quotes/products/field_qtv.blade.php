
@php
    $disable_field = !empty($disable_all) || in_array('note', @$arr_disable ?? []) ? 1 : 0;
    $supp_base_name = 'product['.$pro_index.']['.$key_supp.']';
    if (@$supp_index != '') {
       $supp_base_name .= '['.$supp_index.']['.$key_stage.']';
    }else{
        $supp_base_name .= '['.$key_stage.']';    
    }
    $other_materal = @$materal == \StatusConst::OTHER
@endphp
@if ($other_materal)
    @php
        $note_materal = [
            'name' => $supp_base_name.'[note]',
            'note' => 'Ghi chú chất liệu vật tư',
            'type' => 'textarea',
            'attr' => ['disable_field' => $disable_field],
            'value' => @$value['note']
        ];
        $qtv_materal = [
            'name' => $supp_base_name.'[qtv]',
            'note' => 'Tên',
            'type' => 'text',
            'attr' => [
                'type_input' => 'number',
                'required' => 1,
                'disable_field' => $disable_field
            ],
            'value' => @$value['qtv']
        ];
    @endphp
@else
    @php
        $qtv_materal = [
            'name' => $supp_base_name.'[qtv]',
            'note' => 'Tên',
            'value' => @$value['qtv'],
            'attr' => [
                'required' => 1,
                'disable_field' => $disable_field
            ],
            'type' => 'linking',
            'other_data' => [
                'config' => [
                    'search' => 1
                ],
                'data' => [
                    'table' =>'supply_prices',
                    'where' => ['type' => $key_type, 'supply_id' => $materal]
                ]
            ]
        ];
    @endphp    
@endif
@if (!empty($note_materal))
    @include('view_update.view', $note_materal) 
@endif
@include('view_update.view', $qtv_materal)
@if (isSizeSupplyQuote($key_type))
    @include('quotes.products.papers.size')
@else
    @if ($other_materal)
        @php
            $unit_price_materal = [
                'name' => $supp_base_name.'[unit_price]',
                'note' => 'Đơn giá',
                'type' => 'text',
                'attr' => [
                    'type_input' => 'number',
                    'required' => 1,
                    'disable_field' => $disable_field
                ],
                'value' => @$value['unit_price']
            ];   
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $unit_price_materal) 
            <span class="ml-3 fs-12 color_gray">VD 22 triệu/tấn = 0.0022</span>
        </div>
    @endif
@endif