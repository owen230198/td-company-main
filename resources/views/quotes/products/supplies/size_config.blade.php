@php
    $pro_length = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][length]',
        'note' => 'KT chiều dài',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Đơn vị cm', 'inject_class' => 'otm_size_length'],
        'value' => @$supply_size['length']
    ];
    $pro_width = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][width]',
        'note' => 'Kích thước chiều rộng',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT (cm)'],
        'value' => @$supply_size['width']
    ]; 
@endphp
@include('view_update.view', $pro_length)

@include('view_update.view', $pro_width)