@php
    $base_name = !empty($base_name) ? $base_name : 'product['.$pro_index.']['.$key_supp.']['.$supp_index .']['.$key_stage.']';
@endphp
<div class="d-flex align-items-center mb-2 fs-13">
    <label class="mb-0 min_210 text-capitalize text-right mr-3">
        <span class="fs-15 mr-1">*</span>Kích thước sản xuất 
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = '{{ $base_name }}[length]' placeholder="Chiều dài (cm)" 
        class="form-control input_155" step="any" value="{{ @$value['length'] }}"
        {{ !empty($disable_all) || in_array('size_length', @$arr_disable ?? []) ? 'disabled' : '' }}> 
        <span class="mx-2">X</span>
        <input type="number" name = '{{ $base_name }}[width]' placeholder="Chiều rộng (cm)" 
        class="form-control input_155" step="any"value="{{ @$value['width'] }}"
        {{ !empty($disable_all) || in_array('size_width', @$arr_disable ?? []) ? 'disabled' : '' }}> 
        @if (!empty($other_materal))
            <div class="paper_price_config_input">
                <div class="d-flex align-items-center">
                    <span class="mx-2">X</span>
                    <input type="number" name = '{{ $base_name }}[unit_price]' placeholder="Đơn giá" 
                    class="form-control input_155 price_input_paper" step="any" value="{{ @$value['unit_price'] }}">
                    <span class="ml-3 fs-12 color_gray">VD 22 triệu/tấn = 0.0022</span>
                </div>
            </div>
        @endif
    </div>
</div>