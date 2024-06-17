<div class="quote_handle_section mb-3">
    @if (!empty($dataItem->seri) || !empty($dataItem->code))
        <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center handle_title">
            <span>Mã: <strong>{{ @$dataItem->seri ?? @$dataItem->code }}</strong></span>
        </h3>
    @endif
    @include('quotes.text_info', ['name' => 'Công ty', 'value' => @$customer->name])
    @include('quotes.text_info', ['name' => 'Tỉnh thành', 'value' => getFieldDataById('name', 'citys', @$customer->city)])
    @include('quotes.text_info', ['name' => 'Người liên hệ', 'value' => @$represent->name])
    @include('quotes.text_info', ['name' => 'Số di động', 'value' => @$represent->phone])
    @include('quotes.text_info', ['name' => 'Số cố định', 'value' => @$represent->telephone])
    @include('quotes.text_info', ['name' => 'Email', 'value' => @$represent->email])
    @if (!empty($dataItem->total_amount) && (int) $dataItem->total_amount > 0)
        <div class="d-flex align-items-center mb-2 fs-15">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Tổng chi phí: </label>
            <p class="font_bold color_red">
                {{ number_format((int) $dataItem->total_amount) }}đ
            </p>
        </div>
    @endif
</div>