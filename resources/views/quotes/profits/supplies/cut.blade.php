<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['machine']))
        <li>
            <span>Thiết bị: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'devices', $stage['machine']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['model_price']))
        <li>
            <span>ĐG Chi phí khuôn: </span>
            <strong class="color_red">{{ number_format((float) $stage['model_price']) }}đ</strong>
        </li>
    @endif

    @if (!empty($stage['shape_price']))
        <li>
            <span>ĐG chỉnh máy: </span>
            <strong class="color_red">{{ number_format((float) $stage['shape_price']) }}đ</strong>
        </li>
    @endif

    @if (!empty($stage['work_price']))
        <li>
            <span>ĐG lượt: </span>
            <strong class="color_red">{{ number_format((float) $stage['work_price']) }}đ</strong>
        </li>
    @endif
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @php
        convertCmToMeter($size['length'], $size['width'])
    @endphp
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(1) Chi phí vật tư khuôn:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">Dài x Rộng x ĐG Chi phí khuôn </p>
            <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['model_price'] }}</p>
            <p class="font_bold formula_result"> = {{ number_format($size['length'] * $size['width'] * $stage['model_price']) }}đ</p>
        </div>
    </div>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(2) Chi phí vật tư:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                Dài ({{ $size['length'] }}) x Rộng x ĐG vật tư x SL tờ in cả BH  x HS
            </p>
            <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x 0 x {{ $stage['supp_qty'] }} x 1</p>
            <p class="font_bold formula_result"> = {{ number_format($size['length'] * $size['width'] * 0 * $stage['supp_qty']) }}đ</p>
        </div>
    </div>   
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(3) Chi phí chỉnh máy:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                ĐG chỉnh máy ({{ $stage['shape_price'] }})
            </p>
            <p class="font_bold formula_result"> = {{ number_format($stage['shape_price']) }}đ</p>
        </div>
    </div> 
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">(4) Chi phí lượt:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">
                SL tờ in cả BH x ĐG lượt x HS
            </p>
            <p class="font_bold formula_result"> = {{ $stage['supp_qty'] }} x {{ $stage['work_price'] }} x 1</p>
            <p class="font_bold formula_result"> = {{ number_format($stage['supp_qty'] * $stage['work_price']) }}đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí: (1) + (2) + (3) + (4) = {{ number_format($stage['total']) }}đ</p>       
</div>