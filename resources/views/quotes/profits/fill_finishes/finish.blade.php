<ul>
    @if (!empty($stage['qty_pro']))
        <li>
            <span>SL sản phẩm: </span>
            <strong class="color_red">{{ $stage['qty_pro'] }}</strong>
        </li>
    @endif

    @if (!empty($stage['ext_price']))
        <li>
            <span>ĐG Phát sinh chi tiết hoàn thiện khó: </span>
            <strong class="color_red">{{ number_format($stage['ext_price']) }}đ</strong>
        </li>
    @endif
</ul>
<div class="d-flex align-items-center mt-2 pt-2 border_top">
    <p class="font_bold">Các công đoạn hoàn thiện:</p>
        @if (!empty($stage['stage']))
            @foreach ($stage['stage'] as $fstage)
                @if ($fstage['cost'] > 0)
                    <li class="mb-1 pb-1">
                        @php
                            convertCmToMeter($fstage['length'], $fstage['width'])
                        @endphp
                        <div class="mb-2 d-flex align-items-center">
                            <span class="mr-1">Công đoạn hoàn thiện : </span>
                            <p class="font_bold">{{ getFieldDataById('name', 'supply_prices', @$fstage['materal']) }}</p>
                        </div>
                        <div class="mb-2 d-flex align-items-center">
                            <span class="mr-1">Chi phí công đoạn : </span>
                            <p class="font_bold">{{ number_format($fstage['qttv_price']) }}đ</p>
                        </div>
                        <div class="mb-2 d-flex align-items-center">
                            <span class="mr-1">Chi phí : </span>
                            <p class="font_bold color_red">SL sản phẩm x Chi phí công đoạn = {{ $fstage['cost'] }}</p>
                        </div>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>

<div class="mt-2 pt-2 border_top_thin formula_tab">
    <p class="fs-15 color_green mb-2 font_bold">Công Thức Tính</p>
    <div class="formula_item d-flex align-items-center color_brown mb-1">
        <p class="formula_name font_bold">Chi phí hoàn thiện:</p>
        <div class="formula_content d-flex align-items-center">
            <p class="formula_param mx-2">Tổng chi phí công đoạn hoàn thiện + (SL sản phẩm x ĐG Phát sinh chi tiết hoàn thiện khó) </p>
            <p class="font_bold formula_result mr-2"> = {{ $stage['finish_cost'] }} + ({{ $stage['qty_pro'] }} x {{ $stage['ext_price'] }})</p>
            <p class="font_bold formula_result"> = {{ number_format($stage['total']) }}đ</p>
        </div>
    </div>
    <p class="fs-15 color_red font_bold">Tổng chi phí bồi: {{ number_format($stage['total']) }}đ</p>       
</div>