<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL tờ in cả BH: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['materal']))
        <li>
            <span>Chất liệu giấy: </span>
            <strong class="color_red">{{ @$stage['materal'] == 'other' ? 'Giấy khác' : getFieldDataById('name', 'materals', $stage['materal']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['materal_price']))
        <li>
            <span>ĐG chất liệu giấy: </span>
            <strong class="color_red">{{ $stage['materal_price'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['qttv']))
        <li>
            <span>Định lượng: </span>
            <strong class="color_red">{{ $stage['qttv'] }}</strong>
        </li>
    @endif
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @if (\GroupUser::isAdmin())
        @php
            convertCmToMeter($size['length'], $size['width'])
        @endphp
        <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí vật tư giấy in:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">Dài x Rộng x ĐG giấy in x Định lượng (SL tờ in + BH giấy in) </p>
                <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['materal_price'] }} x {{ $stage['qttv'] }} x {{ $stage['supp_qty'] }}</p>
                <p class="font_bold formula_result"> = {{ number_format($size['length'] * $size['width'] * $stage['materal_price'] * $stage['qttv'] * $stage['supp_qty']) }}đ</p>
            </div>
        </div>
    @endif
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư giấy in: {{ number_format($stage['total']) }}đ</p>       
</div>