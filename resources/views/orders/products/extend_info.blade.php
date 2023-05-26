@php
    $pro_per_price = (int) @$product['total_cost'] / (int) @$product['qty'];
    $ext_pro_fields = [
        'per_price' => 
        [
            'name' => $pro_base_name_input.'[per_price]',
            'note' => 'Đơn giá sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($pro_per_price)
        ],
        'total_cost' =>
        [
            'name' => $pro_base_name_input.'[total_cost]',
            'note' => 'Tổng chi phí sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($product['total_cost'])
        ],
        'custom_design_file' =>
        [
            'name' => $pro_base_name_input.'[custom_design_file]',
            'note' => 'File thiết kế khách gửi',
            'type' => 'file'
        ],
        'sale_shape_file' =>
        [
            'name' => $pro_base_name_input.'[sale_shape_file]',
            'note' => 'Khuôn kinh doanh tính giá',
            'type' => 'file'
        ],
        'tech_shape_file' =>
        [
            'name' => $pro_base_name_input.'[tech_shape_file]',
            'note' => 'Khuôn sản xuất (Kỹ thuật)',
            'type' => 'file'
        ],
        'design_file' =>
        [
            'name' => $pro_base_name_input.'[design_file]',
            'note' => 'File gốc (P. Thiết kế)',
            'type' => 'file'
        ],
        'design_shape_file' =>
        [
            'name' => $pro_base_name_input.'[design_shape_file]',
            'note' => 'File bình theo khuôn (P. Thiết kế)',
            'type' => 'file'
        ],
        'note_prince' => 
        [
            'name' => $pro_base_name_input.'[note][print]',
            'note' => 'Ghi chú cho khâu in',
            'type' => 'linking',
            'other_data' => ['data' => ['table' => 'print_notes', 'select' => ['id', 'name']]]
        ],
        'note_handle' =>
        [
            'name' => $pro_base_name_input.'[note][handle]',
            'note' => 'Ghi chú cho khâu gia công',
            'type' => 'textarea'
        ]
    ];
    if (in_array(\GroupUser::getCurrent(), [\GroupUser::SALE])) {
        unset($ext_pro_fields['tech_shape_file'], $ext_pro_fields['design_file'], $ext_pro_fields['design_shape_file']);    
    }
@endphp

@foreach ($ext_pro_fields as $ext_pro_field)
    @include('view_update.view', $ext_pro_field)     
@endforeach