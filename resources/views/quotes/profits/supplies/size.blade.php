<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL vật tư cả BH: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['supply_type']))
        <li>
            <span>Loại vật tư: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'supply_types', $stage['supply_type']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['supply_price']))
        <li>
            @php
                $title = isNoQuantativeSupply(@$supply['pro_field']) ? 'Loại vật tư' : 'Vật tư định lượng';
                $table_get = isNoQuantativeSupply(@$supply['pro_field']) ? 'materals' : 'supply_prices';
            @endphp
            <span>{{ $title }}: </span>
            <strong class="color_red">{{  getFieldDataById('name', $table_get, $stage['supply_price']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['qttv_price']))
        <li>
            <span>ĐG vật tư: </span>
            <strong class="color_red">{{ (float) $stage['qttv_price'] }}đ</strong>
        </li>
    @endif

    @if (!empty($size['prescript_price']))
        <li>
            <span>Phát sinh vật tư cao cấp: </span>
            <strong class="color_red">{{ number_format((float) $size['prescript_price']) }}đ</strong>
        </li>
    @endif

</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @php
        convertCmToMeter($size['length'], $size['width'])
    @endphp
    @if (\GroupUser::isAdmin())
        <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí vật tư:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">
                    Dài x Rộng x ĐG x (SL vật tư + BH) {{ !empty($size['prescript_price']) ? ' + (Phát sinh vật tư cao cấp x SL vật tư)' : '' }}
                </p>
                <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['qttv_price'] }} x {{ $stage['supp_qty'] }} {{ !empty($size['prescript_price']) ? ' + ('.$stage['prescript_price'].' x '. $stage['supp_qty'].')' : '' }}</p>
                <p class="font_bold formula_result"> = {{ number_format($stage['total']) }}đ</p>
            </div>
        </div>
    @endif
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư: {{ number_format($stage['total']) }}đ</p>       
</div>