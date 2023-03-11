@extends('index')
@section('css')
    <link rel="stylesheet" href="frontend/admin/css/quote.css">
    <link rel="stylesheet" href="frontend/base/css/bootstrap-multiselect.min.css">
@endsection
@section('content')
    <div class="quote_handle_section mb-3">
        <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center">
            <span>Thông tin khách hàng</span>
        </h3>
        @foreach ($customer_fields as $customer)
            <div class="d-flex align-items-center mb-2 fs-13">
                <label class="mb-0 min_150 text-capitalize text-right mr-3">{{ $customer['note'] }}: </label>
                <p class="font_italic color_green">
                    @if (!empty($data_quote[$customer['name']]))
                        {{ 
                            @$customer['type'] != 'linking' ? $data_quote[$customer['name']] 
                            : getFieldDataById('name', $customer['other_data']['data']['table'], $data_quote[$customer['name']]) 
                        }}
                    @endif
                </p>
            </div>    
        @endforeach
    </div>
    <div class="quote_handle_section mb-3">
        <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center">
            <span>Khởi tạo sản phẩm</span>
        </h3>
        @php
            $pro_qty_field = [
                'name' => 'product[qty]',
                'note' => 'Số lượng sản phẩm',
                'attr' => ['type_input' => 'number']
            ] 
        @endphp
        @include('view_update.view', $pro_qty_field)
        <div class="ajax_product_quote_number">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <label class="mb-0 min_150 mr-3"></label>
                <li class="nav-item">
                    <a class="nav-link active" id="quote-pro-1-tab" data-toggle="pill" href="#quote-pro-1" role="tab" aria-controls="quote-pro-1" aria-selected="true">Sản phẩm 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="quote-pro-2-tab" data-toggle="pill" href="#quote-pro-2" role="tab" aria-controls="quote-pro-2" aria-selected="false">Sản phẩm 2</a>
                </li>
            </ul>
             <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="quote-pro-1" role="tabpanel" aria-labelledby="quote-pro-1-tab">
                    <div class="mb-2">
                        @php
                            $pro_name_field = [
                                'name' => 'product[name]',
                                'note' => 'Tên sản phẩm',
                            ] 
                        @endphp
                        @include('view_update.view', $pro_name_field)
                        
                        @php
                            $pro_group_field = [
                                'name' => 'product[group]',
                                'type' => 'linking',
                                'note' => 'Nhóm sản phẩm',
                                'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'product_categories']]
                            ] 
                        @endphp
                        @include('view_update.view', $pro_group_field)
                    </div>
                    <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center">
                        <span>Sản phẩm gồm các chi tiết sau</span>
                    </h3>
                    @php
                        $pro_design_field = [
                            'name' => 'product[design]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Thiết kế',
                            'other_data' => ['data' => ['table' => 'qs_type_designs']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_design_field)

                    @php
                        $pro_print_form_field = [
                            'name' => 'product[print_form]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Làm mẫu',
                            'other_data' => ['data' => ['table' => 'qs_print_forms']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_print_form_field)
                    
                    @php
                        $pro_print_tech_field = [
                            'name' => 'product[print_tech]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Công nghệ in',
                            'other_data' => ['data' => ['table' => 'qs_print_techs']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_print_tech_field)  

                    @php
                        $pro_after_print_field = [
                            'name' => 'product[name]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Công đoạn sau in',
                            'other_data' => ['data' => ['table' => 'qs_after_prints']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_after_print_field)

                    @php
                        $pro_box_fill_field = [
                            'name' => 'product[box_fill]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Bồi hộp',
                            'other_data' => ['data' => ['table' => 'qs_box_fills']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_box_fill_field)
                    
                    @php
                        $pro_finish_field = [
                            'name' => 'product[finish]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Hoàn thiện',
                            'other_data' => ['data' => ['table' => 'qs_finishes']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_finish_field)

                    @php
                        $pro_shipping_field = [
                            'name' => 'product[shipping]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Hoàn thiện',
                            'other_data' => ['data' => ['table' => 'qs_shipping_types']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_shipping_field)
                </div>
                <div class="tab-pane fade" id="quote-pro-2" role="tabpanel" aria-labelledby="quote-pro-2-tab">
    
                </div>
            </div>   
        </div>
    </div>  
@endsection
@section('script')
<script src="frontend/base/script/bootstrap-multiselect.min.js"></script>
<script src="frontend/admin/script/quote.js"></script>
    
@endsection