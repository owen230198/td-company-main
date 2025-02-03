@extends('orders.users.6.supply_handles.supplies')
@section('process')
<div class="plan_handle_supp_inf">
    @if (checkNeedHandleMagnet($supply_size))
        @php
            $materal = $supply_size['materal'];
            $qtv = $supply_size['qtv'];

            $supply_size_qty = [
                'name' => 'magnet_number',
                'note' => 'Số viên nam châm/hộp',
                'value' => @$supply_size['qty'],
                'attr' => ['type_input' => 'number', 'readonly' => 1]
            ];

            $data_product_qty = [
                'name' => '',
                'note' => 'Số lượng sản phẩm',
                'value' => @$supply_obj->product_qty,
                'attr' => ['type_input' => 'number', 'disable_field' => 1]
            ];
            $base_need_supp = @$supply_obj->product_qty * $supply_size['qty'];
            $take_need_qty = calValuePercentPlus($base_need_supp, $base_need_supp, getDataConfig('QuoteConfig', 'MAGNET_COMPEN_PERCENT'));
        @endphp

        @include('view_update.view', $supply_size_qty)

        @include('view_update.view', $data_product_qty)

        @include('orders.users.6.supply_handles.view_handles.multiple', 
        [
            'arr_items' => [
                'key_supp' => \TDConst::MAGNET, 
                'note' => 'nam châm', 
                'supp_price' => $supply_size['materal'],
                'base_need' => $take_need_qty,
                'qtv' => $supply_size['qtv'],
            ],
            'type' => \TDConst::MAGNET
        ])
    @else
        <p class="fs-17 color_red font-italic">Sản phẩm không cần xuất nam châm, có thể hoàn tất ngay để duyệt sản xuất !</p>
    @endif
</div>
@endsection