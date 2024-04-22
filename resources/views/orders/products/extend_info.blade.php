@php
    $pro_per_price = (int) @$product['total_amount'] / (int) @$product['qty'];
    $ext_pro_fields_inf = [
        'per_price' => 
        [
            'name' => $pro_base_name_input.'[per_price]',
            'note' => 'Đơn giá sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($pro_per_price)
        ],
        'total_amount' =>
        [
            'name' => $pro_base_name_input.'[total_amount]',
            'note' => 'Tổng chi phí sản phẩm',
            'attr' => ['disable_field' => 1],
            'value' => number_format($product['total_amount'])
        ],
    ];
    
@endphp

@if (\GroupUser::isAdmin() || \GroupUser::isSale())
    @foreach ($ext_pro_fields_inf as $ext_pro_field)
        @include('view_update.view', $ext_pro_field)     
    @endforeach
@endif

@include('orders.products.file_field')