<div class="mb-2 detail_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Sản phẩm gồm các chi tiết sau</span>
    </h3>
    @php
        $pro_design_field = [
            'name' => 'product['.$pro_index.'][design]',
            'type' => 'linking',
            'note' => 'Thiết kế',
            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'qs_type_designs']]
        ] 
    @endphp
    @include('view_update.view', $pro_design_field)

    @php
        $pro_print_form_field = [
            'name' => 'product['.$pro_index.'][print_form]',
            'type' => 'multiplechoicelinking',
            'note' => 'Làm mẫu',
            'other_data' => ['data' => ['table' => 'qs_print_forms']]
        ] 
    @endphp
    @include('view_update.view', $pro_print_form_field)
    
    @php
        $pro_print_tech_field = [
            'name' => 'product['.$pro_index.'][print_tech]',
            'type' => 'multiplechoicelinking',
            'note' => 'Công nghệ in',
            'other_data' => ['data' => ['table' => 'qs_print_techs']]
        ] 
    @endphp
    @include('view_update.view', $pro_print_tech_field)  

    @php
        $pro_after_print_field = [
            'name' => 'product['.$pro_index.'][name]',
            'type' => 'multiplechoicelinking',
            'note' => 'Công đoạn sau in',
            'other_data' => ['data' => ['table' => 'qs_after_prints']]
        ] 
    @endphp
    @include('view_update.view', $pro_after_print_field)

    @php
        $pro_box_fill_field = [
            'name' => 'product['.$pro_index.'][box_fill]',
            'type' => 'multiplechoicelinking',
            'note' => 'Bồi hộp',
            'other_data' => ['data' => ['table' => 'qs_box_fills']]
        ] 
    @endphp
    @include('view_update.view', $pro_box_fill_field)
    
    @php
        $pro_finish_field = [
            'name' => 'product['.$pro_index.'][finish]',
            'type' => 'multiplechoicelinking',
            'note' => 'Hoàn thiện',
            'other_data' => ['data' => ['table' => 'qs_finishes']]
        ] 
    @endphp
    @include('view_update.view', $pro_finish_field)

    @php
        $pro_shipping_field = [
            'name' => 'product['.$pro_index.'][shipping]',
            'type' => 'multiplechoicelinking',
            'note' => 'Vận chuyển',
            'other_data' => ['data' => ['table' => 'qs_shipping_types']]
        ] 
    @endphp
    @include('view_update.view', $pro_shipping_field)
</div>