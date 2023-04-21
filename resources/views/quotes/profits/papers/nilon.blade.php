<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['materal']))
        <li>
            <span>Chất liệu cán: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'materals', $stage['materal']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['materal_price']))
        <li>
            <span>ĐG chất liệu cán: </span>
            <strong class="color_red">{{ number_format((float) $stage['materal_price']) }}đ</strong>
        </li>
    @endif

    @if (!empty($stage['face']))
        <li>
            <span>Số mặt cán: </span>
            <strong class="color_red">{{ $stage['face'] }}</strong>
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
            <span>DG Chi phí khuôn: </span>
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
<div class="mt-3 p-2 formula_tab">
    <p class="fs-14 color_green mb-2">Công thức tính</p>
    <div class="formula_item d-flex align-items-center color_brown">
        <p class="formula_name">(1) Chi phí vật tư khuôn:</p>
        <div class="formula_content">
            @php
                convertCmToMeter($size['length'], $size['width'])
            @endphp
            <p class="formula_">Dài ({{ $size['length'] }}) x Rộng ({{ $size['width'] }}) x ĐG Chi phí khuôn ({{ $stage['model_price'] }}) </p>
            <p class="font_bold formula_result"> = {{ $size['length'] * $size['width'] * $stage['model_price'] }}</p>
        </div>
    </div>      
</div>