@php
    $pro_per_price = (int) @$product['total_cost'] / (int) @$product['qty'];
    $ext_pro_fields = [
        [
            'name' => $pro_base_name_input.'[per_price]',
            'note' => 'Đơn giá sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($pro_per_price)
            ],
            [
                'name' => $pro_base_name_input.'[total_cost]',
                'note' => 'Tổng chi phí sản phẩm',
                'attr' => ['disable_field' => 1],
                'value' => number_format($product['total_cost'])
            ],
            [
                'name' => $pro_base_name_input.'[sale_shape_file]',
                'note' => 'Khuôn kinh doanh tính giá',
                'type' => 'file'
            ],
            [
                'name' => $pro_base_name_input.'[note][print]',
                'note' => 'Ghi chú cho khâu in',
                'type' => 'linking',
                'other_data' => ['data' => ['table' => 'print_notes', 'select' => ['id', 'name']]]
            ],
            [
                'name' => $pro_base_name_input.'[note][handle]',
                'note' => 'Ghi chú cho khâu gia công',
                'type' => 'textarea'
            ]
    ]   
@endphp

@foreach ($ext_pro_fields as $ext_pro_field)
    @include('view_update.view', $ext_pro_field)     
@endforeach