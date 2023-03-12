@extends('index')
@section('css')
    <link rel="stylesheet" href="frontend/admin/css/quote.css">
    <link rel="stylesheet" href="frontend/base/css/bootstrap-multiselect.min.css">
@endsection
@section('content')
    <div class="quote_handle_section mb-3">
        <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center quote_handle_title">
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
        <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center quote_handle_title">
            <span>Khởi tạo sản phẩm</span>
        </h3>
        @php
            $quote_pro_qty_field = [
                'name' => 'quote[product_qty]',
                'note' => 'Số lượng sản phẩm',
                'attr' => ['type_input' => 'number']
            ] 
        @endphp
        @include('view_update.view', $quote_pro_qty_field)
        <div class="ajax_product_quote_number">
            <ul class="nav nav-pills mb-3" id="quote-pro-tab" role="tablist">
                <label class="mb-0 min_150 mr-3"></label>
                <li class="nav-item">
                    <a class="nav-link active" id="quote-pro-1-tab" data-toggle="pill" href="#quote-pro-1" role="tab" aria-controls="quote-pro-1" aria-selected="true">Sản phẩm 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="quote-pro-2-tab" data-toggle="pill" href="#quote-pro-2" role="tab" aria-controls="quote-pro-2" aria-selected="false">Sản phẩm 2</a>
                </li>
            </ul>
             <div class="tab-content" id="quote-pro-tabContent">
                <div class="tab-pane fade show active" id="quote-pro-1" role="tabpanel" aria-labelledby="quote-pro-1-tab">
                    <div class="config_handle_paper_pro">
                        <div class="mb-2 base_product_config">
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
                        
                        <div class="mb-2 detail_product_config">
                            <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center quote_handle_title">
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
    
                        <div class="list_paper_config">
                            <div class="mb-2 paper_product_config">
                                <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center quote_handle_title">
                                    <span>Phần giấy in</span>
                                </h3>
                                @php
                                    $pro_paper_name = [
                                        'name' => 'product[paper][name]',
                                        'note' => 'Tên SP giấy in',
                                    ] 
                                @endphp
                                @include('view_update.view', $pro_paper_name)
                                <div class="d-flex align-items-center mb-2 fs-13">
                                    <label class="mb-0 min_150 text-capitalize text-right mr-3">
                                        <span class="fs-15 mr-1">*</span>Kích thước 
                                    </label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="number" name = 'product[size][length]' placeholder="Dài" class="form-control short_input"> <span class="mx-3">X</span>
                                        <input type="number" name = 'product[size][width]' placeholder="Rộng" class="form-control short_input"> <span class="mx-3">X</span>
                                        <input type="number" name = 'product[size][height]' placeholder="Cao" class="form-control short_input">
                                    </div>
                                </div>
                                <div class="quantity_paper_module">
                                    @php
                                        $pro_qty_field = [
                                            'name' => 'product[paper][qty]',
                                            'note' => 'Số lượng',
                                            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_qty_field)
        
                                    @php
                                        $pro_nqty_field = [
                                            'name' => 'product[paper][nqty]',
                                            'note' => 'Số bát/tờ in',
                                            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                                            'value' => 1
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_nqty_field)
                                    
                                    @php
                                        $pro_paper_qty = [
                                            'name' => 'product[paper][paper_qty]',
                                            'note' => 'Tờ in chuẩn',
                                            'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_paper_qty) 
        
                                    @php
                                        $pro_total_paper_qty = [
                                            'name' => 'product[paper][total_paper_qty]',
                                            'note' => 'Tổng cả BH',
                                            'attr' => ['type_input' => 'number', 'inject_class' => 'total_paper_qty_input']
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_total_paper_qty)
                                </div>
                                <div class="materal_paper_module">
                                    @php
                                        $pro_paper_materals = [
                                            'name' => 'product[paper][paper_materals]',
                                            'type' => 'linking',
                                            'note' => 'Chọn chất liệu giấy',
                                            'attr' => ['required' => 1, 'inject_class' => 'select_paper_materal'],
                                            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'paper_materals']]
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_paper_materals)
                                    
                                    @php
                                        $pro_paper_quantitative = [
                                            'name' => 'product[paper][quantitative]',
                                            'note' => 'Định lượng',
                                            'attr' => ['type_input' => 'number', 'required' => 1]
                                        ] 
                                    @endphp
                                    @include('view_update.view', $pro_paper_quantitative)
                                    <div class="d-flex align-items-center mb-2 fs-13">
                                        <label class="mb-0 min_150 text-capitalize text-right mr-3">
                                            <span class="fs-15 mr-1">*</span>Khổ giấy in
                                        </label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <input type="number" name = 'product[paper][size][length]' placeholder="Chiều dài" class="form-control medium_input"> <span class="mx-3">X</span>
                                            <input type="number" name = 'product[paper][size][width]' placeholder="Chiều rộng" class="form-control medium_input"> 
                                            <div class="paper_price_config_input" style="display: none">
                                                <div class="d-flex align-items-center">
                                                    <span class="mx-3">X</span>
                                                    <input type="number" name = 'product[paper][size][height]' placeholder="Đơn giá" class="form-control medium_input price_input_paper" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="mb-2 handle_after_print_config">
                                <h3 class="fs-14 text-uppercase color_green border_bot_eb pb-1 mb-3 text-center quote_handle_title">
                                    <span>Phần Sản xuất sau in</span>
                                </h3>
        
                                <div class="quote_after_print_tab">
                                    <div class="d-flex">
                                        <div class="nav flex-column nav-pills  min_150 max_150 mr-3 bg_white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link text-right active" id="v-print_type-tab" data-toggle="pill" href="#v-print_type" role="tab" aria-controls="v-print_type" aria-selected="true">
                                                Quy Cách - kiểu in
                                            </a>
                                            <a class="nav-link text-right" id="v-nilon_cover-tab" data-toggle="pill" href="#v-nilon_cover" role="tab" aria-controls="v-nilon_cover" aria-selected="false">
                                                Cán nilon
                                            </a>
                                            <a class="nav-link text-right" id="v-metalai_cover-tab" data-toggle="pill" href="#v-metalai_cover" role="tab" aria-controls="v-metalai_cover" aria-selected="false">
                                                Cán Metalai
                                            </a>
                                            <a class="nav-link text-right" id="v-glossy_compress-tab" data-toggle="pill" href="#v-glossy_compress" role="tab" aria-controls="v-glossy_compress" aria-selected="false">
                                                Ép Nhũ
                                            </a>
                                            <a class="nav-link text-right" id="v-floating-tab" data-toggle="pill" href="#v-floating" role="tab" aria-controls="v-floating" aria-selected="false">
                                                Thúc nổi
                                            </a>
                                            <a class="nav-link text-right" id="v-uv_print-tab" data-toggle="pill" href="#v-uv_print" role="tab" aria-controls="v-uv_print" aria-selected="false">
                                                In lưới UV
                                            </a>
                                            <a class="nav-link text-right" id="v-elevated-tab" data-toggle="pill" href="#v-elevated" role="tab" aria-controls="v-elevated" aria-selected="false">
                                                Máy bế
                                            </a>
                                            <a class="nav-link text-right" id="v-box_paste-tab" data-toggle="pill" href="#v-box_paste" role="tab" aria-controls="v-box_paste" aria-selected="false">
                                                Máy dán hộp giấy
                                            </a>
                                            <a class="nav-link text-right" id="v-temp_plus-tab" data-toggle="pill" href="#v-temp_plus" role="tab" aria-controls="v-temp_plus" aria-selected="false">
                                                Phát sinh tem toa
                                            </a>
                                            <a class="nav-link text-right" id="v-other_plus-tab" data-toggle="pill" href="#v-other_plus" role="tab" aria-controls="v-other_plus" aria-selected="false">
                                                Phát sinh vật tư khác
                                            </a>
                                        </div>
                                        <div class="tab-content p-3 w-100 bg_eb radius_5" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-print_type" role="tabpanel" aria-labelledby="v-print_type-tab">
                                                Quy Cách - kiểu in
                                            </div>
                                            <div class="tab-pane fade" id="v-nilon_cover" role="tabpanel" aria-labelledby="v-nilon_cover-tab">
                                                Cán nilon
                                            </div>
                                            <div class="tab-pane fade" id="v-metalai_cover" role="tabpanel" aria-labelledby="v-metalai_cover-tab">
                                                Cán Metalai
                                            </div>
                                            <div class="tab-pane fade" id="v-glossy_compress" role="tabpanel" aria-labelledby="v-glossy_compress-tab">
                                                Ép Nhũ
                                            </div>
                                            <div class="tab-pane fade" id="v-floating" role="tabpanel" aria-labelledby="v-floating-tab">
                                                Thúc nổi
                                            </div>
                                            <div class="tab-pane fade" id="v-uv_print" role="tabpanel" aria-labelledby="v-uv_print-tab">
                                                In lưới UV
                                            </div>
                                            <div class="tab-pane fade" id="v-elevated" role="tabpanel" aria-labelledby="v-elevated-tab">
                                                Máy bế
                                            </div>
                                            <div class="tab-pane fade" id="v-box_paste" role="tabpanel" aria-labelledby="v-box_paste-tab">
                                                Máy dán hộp giấy
                                            </div>
                                            <div class="tab-pane fade" id="v-temp_plus" role="tabpanel" aria-labelledby="v-temp_plus-tab">
                                                Phát sinh tem toa
                                            </div>
                                            <div class="tab-pane fade" id="v-other_plus" role="tabpanel" aria-labelledby="v-other_plus-tab">
                                                Phát sinh khác
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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