@extends('orders.users.6.supply_handles.supplies')
@section('process')
<div class="plan_handle_supp_inf">
    @php
        $data_magnet = !empty($supply_obj->magnet) ? json_decode($supply_obj->magnet, true) : [];
        $materal = $data_magnet['materal'];
        $qtv = $data_magnet['qtv'];

        $data_magnet_qty = [
            'name' => 'magnet_number',
            'note' => 'Số viên nam châm/hộp',
            'value' => @$data_magnet['qty'],
            'attr' => ['type_input' => 'number', 'readonly' => 1]
        ];

        $data_product_qty = [
            'name' => '',
            'note' => 'Số lượng sản phẩm',
            'value' => @$supply_obj->product_qty,
            'attr' => ['type_input' => 'number', 'disable_field' => 1]
        ];

        $magnet_chose_supp = [
            'name' => 'c_supply[supp_price]',
            'type' => 'linking',
            'attr' => ['inject_class' => 'length_inpput'],
            'note' => 'Chọn nam châm trong kho',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'supply_warehouses', 
                    'where' => [
                        'type' => \TDConst::MAGNET,
                        'target' => $materal,
                        'qtv' => $qtv,
                        'status' => 'imported'
                    ]
                ]
            ]
        ]
    @endphp
    <h3 class="fs-14 text-uppercase border_bot_eb pb-3 mb-3 text-center handle_title">
        <p class="mb-1">
            Xuất vật tư nam châm - {{ getFieldDataById('name', 'supply_types', $data_magnet['materal']) }}
            - {{ getFieldDataById('name', 'supply_prices', $data_magnet['qtv']) }}
        </p>
    </h3>

    @include('view_update.view', $data_magnet_qty)

    @include('view_update.view', $data_product_qty)

    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nam châm theo yêu cầu</span>
    </h3>

    @include('view_update.view', $magnet_chose_supp)
</div>
@endsection