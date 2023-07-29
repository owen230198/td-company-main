<div class="d-flex align-items-center mb-2 fs-13">
    <label class="mb-0 min_210 text-capitalize text-right mr-3">
        <span class="fs-15 mr-1">*</span>Kích thước khổ giấy
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][length]' placeholder="Chiều dài (cm)" 
        class="form-control medium_input" step="any" value="{{ @$supply_size['length'] }}"> 
        <span class="mx-3">X</span>
        <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][width]' placeholder="Chiều rộng (cm)" 
        class="form-control medium_input" step="any"value="{{ @$supply_size['width'] }}"> 
        <div class="paper_price_config_input" style="display:{{ @$supply_size['materal'] != 'other' ? 'none' : 'block' }}">
            <div class="d-flex align-items-center">
                <span class="mx-3">X</span>
                <input type="number" name = 'product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][size][unit_price]' placeholder="Đơn giá" 
                class="form-control medium_input price_input_paper" 
                {{ @$supply_size['materal'] != 'other' ? 'disabled="disabled"' : '' }} step="any" value="{{ @$supply_size['unit_price'] }}">
                <span class="ml-3 fs-12 color_gray">VD 22 triệu/tấn = 0.00022</span>
            </div>
        </div>
    </div>
</div>