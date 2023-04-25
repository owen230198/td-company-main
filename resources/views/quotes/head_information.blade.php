<div class="quote_handle_section mb-3">
    <h3 class="fs-14 text-uppercase pb-1 mb-3 text-center quote_handle_title">
        <span>Mã báo giá <strong>{{ $data_quote['seri'] }}</strong></span>
    </h3>
    @php
        $field_infomation = \App\Models\Customer::FIELD_UPDATE;
    @endphp
    @foreach ($field_infomation as $customer)
        @if (!empty($data_quote[$customer['name']]))
            <div class="d-flex align-items-center mb-2 fs-13">
                <label class="mb-0 min_210 text-capitalize text-right mr-3">{{ $customer['note'] }}: </label>
                <p class="font_italic">
                    {{ 
                        @$customer['type'] != 'linking' ? $data_quote[$customer['name']] 
                        : getFieldDataById('name', $customer['other_data']['data']['table'], $data_quote[$customer['name']]) 
                    }}
                </p>
            </div>
        @endif    
    @endforeach
    @if ((int) $data_quote['total_amount'] > 0)
        <div class="d-flex align-items-center mb-2 fs-15">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Tổng chi phí báo giá: </label>
            <p class="font_bold color_red">
                {{ number_format((int) $data_quote['total_amount']) }}đ
            </p>
        </div>
    @endif
</div>