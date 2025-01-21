<ul>
    @if (!empty($stage['qty_pro']))
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red">{{ $stage['qty_pro'] }}</strong>
        </li>
    @endif
    @if (!empty($stage['materal']))
        <li>
            <span>Chất liệu vật tư: </span>
            <strong class="color_red">{{ @$stage['materal'] == \StatusConst::OTHER ? 'vật tư khác' : getFieldDataById('name', 'supply_types', $stage['materal']) }}</strong>
        </li>
    @endif
    @if (!empty($stage['price']))
        <li>
            <span>ĐG chất liệu vật tư: </span>
            <strong class="color_red">{{ $stage['qtv_price'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['qtv']))
        <li>
            <span>Tên định lượng: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'supply_prices', $stage['qtv']) }}</strong>
        </li>
    @endif
    @if (!empty($stage['qtv_num']))
        <li>
            <span>Định lượng: </span>
            <strong class="color_red">{{ $stage['qtv_num'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['qty']))
        <li>
            <span>SL nam châm/hộp: </span>
            <strong class="color_red">{{ $stage['qty'] }}</strong>
        </li>
    @endif
</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @if (\GroupUser::isAdmin())
        <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí vật tư nam châm:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">(SL sản phẩm x ĐG nam châm) x SL nam châm/hộp </p>
                <p class="font_bold formula_result mr-2"> = ({{ $stage['qty_pro'] }} x {{ $stage['qtv_price'] }}) x {{ $stage['qty'] }}</p>
                <p class="font_bold formula_result"> = {{ number_format($stage['total']) }}đ</p>
            </div>
        </div>
    @endif
    <p class="fs-15 color_red font_bold">Tổng chi phí cho vật tư nam châm: {{ number_format($stage['total']) }}đ</p>       
</div>