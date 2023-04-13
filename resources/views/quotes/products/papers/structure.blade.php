<h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
    <span>Phần kích thước sản phẩm</span>
</h3>
<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
        Nhập kích thước hộp
    </label>
    <div class="d-flex align-items-center">
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">1</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][length]' 
                placeholder="Nhập chiều dài" class="form-control medium_input text-center struture_pro_input" step="any"
                value="{{ @$pro_size['length'] }}">
            </div>
            <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">2</p>
            <div class="d-flex justify-content-between align-items-center">
                <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][width]' 
                placeholder="Nhập chiều rộng" class="form-control medium_input text-center struture_pro_input" step="any"
                value="{{ @$pro_size['width'] }}">
            </div>
            <p class="text-center color_gray"><i class="fa fa-arrows-h fs-18" aria-hidden="true"></i></p>
        </div>
        <span class="mx-3">X</span>
        <div class="size_item_pro_structure">
            <p class="text-center color_gray">3</p>
            <div class="d-flex justify-content-between align-items-center height_input">
                <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][height]' 
                placeholder="Nhập chiều cao" class="form-control medium_input text-center struture_pro_input" step="any"
                value="{{ @$pro_size['height'] }}">
                <p class="text-center ml-1 color_gray"><i class="fa fa-arrows-v fs-18" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</div>
@php
    $quote_size_pro_side = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][lid_bottom_type]',
        'attr' => ['inject_class' => 'struture_pro_input'],
        'note' => 'KT hông nắp + đáy',
        'type' => 'select',
        'other_data' => ['data' => ['options' => \App\Constants\TDConstant::PRO_SIZE_SIDE]],
        'value' => @$pro_size['lid_bottom_type'] 
    ]
@endphp
@include('view_update.view', $quote_size_pro_side)

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       KT tai cài hộp
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][lid]' 
            placeholder="Nhập KT nắp" class="form-control medium_input text-center struture_pro_input" step="any"
            value="{{ @$pro_size['lid'] }}">
        </div>
        <span class="mx-3">--</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][bottom]' 
            placeholder="Nhập KT đáy" class="form-control medium_input text-center struture_pro_input" step="any"
            value="{{ @$pro_size['bottom'] }}">
        </div>
    </div>
</div>

@php
    $quote_size_edge = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][edge]',
        'note' => 'KT mép dán',
        'type' => 'text',
        'attr' => ['type_input' => 'number', 'inject_class' => 'struture_pro_input'],
        'value' => @$pro_size['edge'] 
    ]
@endphp
@include('view_update.view', $quote_size_edge)

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Số bát chiều dài
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][nqty_length]' 
            placeholder="Nhập số bát" class="form-control medium_input text-center struture_pro_input nnnnnn" step="any" 
            value="{{ @$pro_size['nqty_length'] }}">
        </div>
        <span class="mx-3">=</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][size_length]' 
            placeholder="KT chiều giấy 1" class="form-control medium_input text-center struture_pro_input" readonly step="any"
            value="{{ @$pro_size['size_lenght'] }}"> 
            <span class="ml-1 color_gray">+10mm</span>
        </div>
    </div>
</div>

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Số bát chiều cao
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][nqty_height]' 
            placeholder="Nhập số bát" class="form-control medium_input text-center struture_pro_input" step="any"
            value="{{ @$pro_size['nqty_height'] }}">
        </div>
        <span class="mx-3">=</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][size_height]' 
            placeholder="KT chiều giấy 2" class="form-control medium_input text-center struture_pro_input" readonly step="any"
            value="{{ @$pro_size['size_height'] }}"> 
            <span class="ml-1 color_gray">+10mm</span>
        </div>
    </div>
</div>

@php
    $quote_size_nqty_space = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][nqty_space]',
        'note' => 'Các bát chiều cao cách nhau',
        'type' => 'text',
        'attr' => ['type_input' => 'number', 'inject_class' => 'struture_pro_input'],
        'value' => @$pro_size['nqty_space'] ?? 3
    ]
@endphp
@include('view_update.view', $quote_size_nqty_space)

@php
    $quote_size_nqty = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][nqty]',
        'note' => 'Số bát/tờ in',
        'type' => 'text',
        'attr' => ['type_input' => 'number', 'placeholder' => 'Hiện tự động', 'inject_class' => 'struture_pro_input'],
        'value' => @$prosize['nqty']
    ]
@endphp
@include('view_update.view', $quote_size_nqty)

@php
    $quote_size_min = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][min_paper_size]',
        'note' => 'Chiều giấy nhỏ nhất',
        'type' => 'text',
        'attr' => ['type_input' => 'number', 'inject_class' => 'struture_pro_input'],
        'value' => @$pro_size['min_paper_size'] ?? 7
    ]
@endphp
@include('view_update.view', $quote_size_min)

<div class="form-group d-flex mb-2">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center">
       Khổ giấy tạm tính
    </label>
    <div class="d-flex align-items-center">
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][temp_length]' 
            placeholder="KT chiều dài" class="form-control medium_input text-center struture_pro_input" readonly step="any"
            value="{{ @$pro_size['temp_length'] }}">
        </div>
        <span class="mx-3">X</span>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][paper][{{ $pindex }}][pro_size][temp_height]' 
            placeholder="KT chiều cao" class="form-control medium_input text-center struture_pro_input" readonly step="any"
            value="{{ @$pro_size['temp_height'] }}"> 
            <span class="ml-1 color_gray">cm</span>
        </div>
    </div>
</div>

@php
    $quote_optimal_paper_lot = [
        'name' => 'product['.$j.'][paper]['.$pindex.'][pro_size][paper_lot]',
        'attr' => ['inject_class' => 'struture_pro_input'],
        'note' => 'Lô giấy tối ưu nhất',
        'type' => 'linking',
        'other_data' => ['data' => ['table'=>'paper_lots', 'select' => ['id', 'name']]],
        'value' => @$pro_size['paper_lot']
    ]
@endphp
<div class="d-flex align-items-end">
    @include('view_update.view', $quote_optimal_paper_lot)
    <div class="group_btn_action_form_compute_size d-flex align-items-center mb-2 ml-5">
        <button type="button" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold 
        smooth auto_computed_btn" data-proindex={{ $j }} data-paperindex={{ $pindex }} >
        <i class="fa fa-calculator mr-2 fs-14" aria-hidden="true"></i>Tính khổ giấy
        </button>
    </div>
</div>
