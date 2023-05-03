@php
    // $pro_temp_length = [
    //     'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][size][temp_length]',
    //     'note' => 'KT chiều dài sơ bộ',
    //     'attr' => ['type_input' => 'number', 'placeholder' => 'Nhập KT(cm)', 'inject_class' => 'temp_size_length'],
    //     'value' => @$supply_size['temp_length']
    // ];
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
<div class="calc_size_module" data-plus = {{ $plus }} data-divide = {{ $divide[0] }}>
    <div class="d-flex alig-items-center">
        @include('view_update.view', $pro_temp_length)
        <span class="ml-1 color_gray mt-1"> + {{ $plus }}cm</span>
    </div>
    
    @include('view_update.view', $pro_length)
</div>


<div class="d-flex">
    @include('view_update.view', $pro_width)
    <span class="ml-1 color_gray mt-1"> + {{ $plus }}cm BH</span>
</div> 