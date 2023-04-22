<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL tờ in cả BH: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['type']))
        <li>
            <span>Kiểu in: </span>
            <strong class="color_red">{{ \TDConst::PRINT_TYPE[$stage['type']] }}</strong>
        </li>
    @endif

    @if (!empty($stage['color']))
        <li>
            <span>Số màu: </span>
            <strong class="color_red">{{ \TDConst::PRINT_COLOR[$stage['color']] }}</strong>
        </li>
    @endif

    @if (!empty($stage['machine']))
        <li>
            <span>Công nghệ in: </span>
            <strong class="color_red">{{ \TDConst::PRINT_TECH[$stage['machine']] }}</strong>
        </li>
    @endif
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @php
        convertCmToMeter($size['length'], $size['width'])
    @endphp
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí vật tư giấy in:</p>   
</div>