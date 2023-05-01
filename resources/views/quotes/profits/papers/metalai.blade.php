<ul>
    @if (!empty($stage['supp_qty']))
        <li>
            <span>SL tờ in: </span>
            <strong class="color_red">{{ $stage['supp_qty'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['cover_supp_qty']))
        <li>
            <span>SL tờ in (phủ trên): </span>
            <strong class="color_red">{{ $stage['cover_supp_qty'] }}</strong>
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

    @if (!empty($stage['cover_materal']))
        <li>
            <span>Chất liệu cán phủ trên: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'materals', $stage['cover_materal']) }}</strong>
        </li>
    @endif

    @if (!empty($stage['materal_cover_price']))
        <li>
            <span>ĐG chất liệu cán phủ trên: </span>
            <strong class="color_red">{{ number_format((float) $stage['materal_cover_price']) }}đ</strong>
        </li>
    @endif

    @if (!empty($stage['cover_face']))
        <li>
            <span>Số mặt cán phủ trên: </span>
            <strong class="color_red">{{ $stage['cover_face'] }}</strong>
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
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính cán metalai</p>
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
                Dài ({{ $size['length'] }}) x Rộng x ĐG chất liệu cán x (SL tờ in cả BH + BH thiết bị)  x Số mặt cán
            </p>
            <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['materal_price'] }} x {{ $stage['supp_qty'] }} x {{ $stage['face'] }}</p>
            <p class="font_bold formula_result"> = {{ number_format($size['length'] * $size['width'] * $stage['materal_price'] * $stage['supp_qty'] * $stage['face']) }}đ</p>
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
                (SL tờ in cả BH + BH thiết bị) x ĐG lượt  x  Số mặt cán
            </p>
            <p class="font_bold formula_result"> = {{ $stage['supp_qty'] }} x {{ $stage['work_price'] }} x {{ $stage['face'] }}</p>
            <p class="font_bold formula_result"> = {{ number_format($stage['supp_qty'] * $stage['work_price'] * $stage['face']) }}đ</p>
        </div>
    </div>
    <p class="fs-15 font_bold">Tổng chi phí cho máy cán metalai: (1) + (2) + (3) + (4) = {{ number_format($stage['metalai_price']) }}đ</p>       
</div>

<div class="mt-2 pt-2 border_top_thin formula_tab">
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính cán phủ trên</p>
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
                Dài ({{ $size['length'] }}) x Rộng x ĐG chất liệu cán phủ trên x (SL tờ in cả BH + BH thiết bị)  x Số mặt cán phủ trên
            </p>
            <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['materal_cover_price'] }} x {{ (int) @$stage['cover_supp_qty'] }} x {{ $stage['cover_face'] }}</p>
            <p class="font_bold formula_result"> = {{ number_format($size['length'] * $size['width'] * $stage['materal_cover_price'] * (int) @$stage['cover_supp_qty'] * $stage['cover_face']) }}đ</p>
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
                (SL tờ in cả BH + BH thiết bị) x ĐG lượt  x  Số mặt cán phủ trên
            </p>
            <p class="font_bold formula_result"> = {{ (int) @$stage['cover_supp_qty'] }} x {{ $stage['work_price'] }} x {{ $stage['cover_face'] }}</p>
            <p class="font_bold formula_result"> = {{ number_format((int) @$stage['cover_supp_qty'] * $stage['work_price'] * $stage['cover_face']) }}đ</p>
        </div>
    </div>
    <p class="fs-15 font_bold">Tổng chi phí cho máy cán: (1) + (2) + (3) + (4) = {{ number_format($stage['metalai_cover_price']) }}đ</p>       
</div>

<div class="mt-2 pt-2 border_top_thin">
    <p class="fs-15 font_bold color_red">Tổng chi phí : Tổng chi phí cán metalai + Tổng chi phí cán phủ trên = {{ (int) @$stage['metalai_price'] }} + {{ (int) @$stage['metalai_cover_price'] }} = {{ number_format($stage['total']) }}đ</p>       
</div>