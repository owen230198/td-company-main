<div class="col-9">
    @php
        $customer_name = $data_customer['name'];
        if (!empty($data_represent['name'])) {
            $customer_name .= ' ('.$data_represent['name'].')';
        }
    @endphp
    <p><span class="mr-1">Tên Khách hàng/Công ty :</span> {{ $customer_name }}</p>
    <p><span class="mr-1">Địa chỉ :</span> {{ $data_customer['address'] }}</p>
    @php
        $phone = @$data_represent['phone'];
        if (!empty($data_represent['telephone']) && $data_represent['telephone'] != $phone) {
            $phone .= ' - '.$data_represent['telephone'];
        }
    @endphp
    @if (!empty($phone))
        <p class="d-flex"><span class="mr-1">Tel :</span> {{ $phone }}</p>   
    @endif
</div>
<div class="col-3">
    <p class="d-flex align-items-center"><span class="w_66 d-block">Số seri</span>  : <span class="fs-18 color_red ml-1 font_bold">{{ $data_item->code }}</span></p>
    <p class="d-flex align-items-center">
        <span class="w_66 d-block">Tỉnh/TP</span>  : 
        <span class="fs-18 color_red ml-1 font_bold">{{ getFieldDataById('name', 'citys', $data_customer['city']) }}</span>
    </p>   
</div>