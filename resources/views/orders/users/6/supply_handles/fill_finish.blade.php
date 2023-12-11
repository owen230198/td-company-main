@extends('orders.users.6.supply_handles.supplies')
@section('process')
<div class="plan_handle_supp_inf">
    <h3 class="fs-14 text-uppercase border_bot_eb pb-3 mb-3 text-center handle_title">
        <p class="mb-1">Thông tin vật tư nam châm cần xuất</p>
    </h3>
    @php
        $data_magnet = !empty($supply_obj->magnet) ? json_decode($supply_obj->magnet, true) : [];
        $data_select_magnet = [
            'other_data' => [
                'data' => ['table' => 'materals', 'where' => ['type' => \TDConst::MAGNET]]
            ],
            'name' => '',
            'type' => 'linking',
            'value' => @$data_magnet['type'],
            'note' => 'Vật tư nam châm',
            'attr' => ['disable_field' => 1]
        ];

        $data_magnet_qty = [
            'name' => 'magnet_number',
            'note' => 'Số viên nam châm/hộp',
            'value' => @$data_magnet['qty'],
            'attr' => ['type_input' => 'number']
        ];
        $magnet_chose_supp = [
            'name' => 'supp_price',
            'type' => 'linking',
            'note' => 'Chọn nam châm trong kho',
            'other_data' => [
                'config' => ['search' => 1], 
                'data' => [
                    'table' => 'other_warehouses', 
                    'where' => ['type' => \TDConst::MAGNET,
                                'supp_price' => @$data_magnet['type'],
                                'status' => 'imported']
                ]
            ]
        ]
    @endphp
    @include('view_update.view', $data_select_magnet)

    @include('view_update.view', $data_magnet_qty)
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Xuất vật tư nam châm theo yêu cầu</span>
    </h3>

    @include('view_update.view', $magnet_chose_supp)
</div>
@endsection