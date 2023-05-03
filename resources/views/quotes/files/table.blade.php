<table class="table table-striped fs-18 mb-0">
    <thead>
        <tr>
            <th scope="col" class="text-center color_red" style="min-width: auto;">STT</th>
            <th scope="col" class="text-center color_red max_content">THÔNG SỐ SẢN PHẨM</th>
            <th scope="col" class="text-center color_red">ĐVT</th>
            <th scope="col" class="text-center color_red">SL</th>
            <th scope="col" class="text-center color_red">ĐG</th>
            <th scope="col" class="text-center color_red">TT</th>
        </tr>
    </thead>
    <tbody class="fs-17 font-italic">
        @foreach ($data_products as $key => $product)
            @php
                $main_paper = \App\Models\Paper::where(['act' => 1, 'main' => 1])->first()->toArray();
                $data_size = !empty($main_paper['size']) ? json_decode($main_paper['size'], true) : [];
                $data_print = !empty($main_paper['print']) ? json_decode($main_paper['print'], true) : [];  
                $data_nilon = !empty($main_paper['nilon']) ? json_decode($main_paper['nilon'], true) : [];
                $data_compress = !empty($main_paper['compress']) ? json_decode($main_paper['compress'], true) : [];
                $data_uv = !empty($main_paper['uv']) ? json_decode($main_paper['uv'], true) : [];
                $data_elevate = !empty($main_paper['elevate']) ? json_decode($main_paper['elevate'], true) : [];
                $data_float = isHardBox($product['category']) ? json_decode(@$main_paper['float'], true) : @$data_elevate['float'];
            @endphp
            <tr>
                <td data-label="Sản phẩm thứ" class="text-center" style="min-width: auto;">{{ $key + 1 }}</td>
                <td data-label="Nội dung" class="font-italic quote_content_section max_content">
                    <p class="d-flex align-items-center mb-1 font_bold">
                        <span class="pro_name fs-18 text-uppercase">{{ @$product['name'] }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Chất liệu giấy: </span>
                        {{ getFieldDataById('name', 'materals', @$data_size['materal']) }}
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Kích thước: </span>
                        <span class="">
                            {{ @$product['size'] }}
                        </span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i>
                             Mẫu thiết kế do: </span>
                        {{ @$product['design'] }}
                    </p>
                    <p class="d-flex align-items-center mb-1 font_bold">
                        <span class="mr-1">
                            <i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i>
                            In: In {{ \TDConst::PRINT_TECH[@$data_print['machine']] }}
                        </span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Hoàn thiện: </span>
                        <span class="font-italic">
                            @if (@$data_nilon['act'] == 1)
                                + Cán nilon: {{ getFieldDataById('name', 'materals', @$data_nilon['materal']).' '. $data_nilon['face'] . ' mặt ' }} 
                            @endif

                            @if (@$data_compress['act'] == 1)
                                + ép nhũ theo maket
                            @endif
                            
                            @if (@$data_uv['act'] == 1)
                                + in lưới UV {{ mb_strtolower(getFieldDataById('name', 'materals', $data_uv['materal'])) }} theo maket   
                            @endif

                            @if (!empty($data_float))
                                + thúc nổi sản phẩm
                            @endif
                        </span>
                    </p>
                    @if (!empty($main_paper['note']))
                        <p class="mb-1">
                            <span class="font_bold mr-1"><i class="fs-10 fa fa-circle mr-1" aria-hidden="true"></i> Ghi chú: </span>
                            <span class="font-italic">
                                {{ $main_paper['note'] }}
                            </span>
                        </p>
                    @endif
                </td>
                <td data-label="DVT" class="text-center">Sản phẩm</td>
                <td data-label="SL" class="text-center">{{ @$product['qty'] }}</td>
                @php
                    $price = (int) $product['total_cost'];
                    $each_price = $price / (int) @$product['qty'];
                @endphp
                <td data-label="ĐG" class="text-center">{{ number_format($each_price) }} đ</td>
                <td data-label="T.Tiền(VNĐ)" class="text-center">{{ number_format(round($price, -3)) }} đ</td>
            </tr>
        @endforeach
    </tbody>
</table>
