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

    @if (!empty($stage['printer']))
        <li>
            <span>Thiết bị máy in: </span>
            <strong class="color_red">{{ getFieldDataById('name', 'printers', $stage['printer']) }}</strong>
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

    @if (!empty($stage['print_factor']))
        <li>
            <span>HS in: </span>
            <strong class="color_red">{{ $stage['print_factor'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['apla_factor']))
        <li>
            <span>Đơn giá in apla: </span>
            <strong class="color_red">{{ $stage['apla_factor'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['apla_plus']))
        <li>
            <span>Chi phí cộng thêm khi in apla: </span>
            <strong class="color_red">{{ number_format($stage['apla_plus']) }}đ</strong>
        </li>
    @endif


</ul>
<div class="mt-2 pt-2 border_top_thin formula_tab">
    @php
        convertCmToMeter($size['length'], $size['width'])
    @endphp
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    @if (@$stage['color'] == \TDConst::APLA_PRINT_COLOR)
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Chi phí in apla:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">Dài x Rộng x ĐG in apla x HS in </p>
                <p class="font_bold formula_result mr-2"> = {{ $size['length'] }} x {{ $size['width'] }} x {{ $stage['apla_factor'] }} x {{ $stage['print_factor'] }}</p>
                <p class="font_bold formula_result"> = {{ number_format($stage['apla_price']) }}đ</p>
            </div>
        </div>
        <div class="formula_item d-flex align-items-center color_brown mb-1">
            <p class="formula_name font_bold">Tổng chi phí:</p>
            <div class="formula_content d-flex align-items-center">
                <p class="formula_param mx-2">(Số lượng tờ in x Chi phí in apla) + Chi phí ộng thêm khi in apla</p>
                <p class="font_bold formula_result mr-2"> = ({{ $stage['supp_qty'] }} x {{ $stage['apla_price'] }}) + {{ $stage['apla_plus'] }}</p>
                <p class="font_bold formula_result color_red"> = {{ number_format($stage['total']) }}đ</p>
            </div>
        </div>
    @else
        @if (@$stage['type'] == \TDConst::ONE_PRINT_TYPE)
            <div class="formula_item d-flex align-items-center color_brown mb-1">
                <p class="formula_name font_bold">Tổng chi phí:</p>
                <div class="formula_content d-flex align-items-center">
                    <p class="formula_param mx-2">(SL tờ in x Số màu x ĐG lượt) + (ĐG chỉnh máy x số màu) + (ĐG Chi phí khuôn x Số màu) </p>
                    <p class="font_bold formula_result mr-2"> = 
                        ({{ $stage['supp_qty'] }} x {{ $stage['color'] }} x {{ $stage['work_price'] }}) + ({{ $stage['shape_price'] }} x {{ $stage['color'] }}) + ({{ $stage['model_price'] }} x {{ $stage['color'] }})
                    </p>
                    <p class="font_bold formula_result color_red"> = {{ number_format($stage['total']) }}đ</p>
                </div>
            </div>    
        @else
            <div class="formula_item d-flex align-items-center color_brown mb-1">
                <p class="formula_name font_bold">Tổng chi phí:</p>
                <div class="formula_content d-flex align-items-center">
                    <p class="formula_param mx-2">(SL tờ in x Số màu x 2 x ĐG lượt) + ((ĐG chỉnh máy x số màu) + (ĐG Chi phí khuôn x số màu)) </p>
                    <p class="font_bold formula_result mr-2"> = 
                        ({{ $stage['supp_qty'] }} x {{ $stage['color'] }} x 2 x {{ $stage['work_price'] }}) + (({{ $stage['shape_price'] }} x {{ $stage['color'] }}) + ({{ $stage['model_price'] }} x {{ $stage['color'] }}))
                    </p>
                    <p class="font_bold formula_result color_red"> = {{ number_format($stage['total']) }}đ</p>
                </div>
            </div>     
        @endif
    @endif
</div>