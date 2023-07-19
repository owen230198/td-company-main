<table class="table table-bordered fs-18 mb-0">
    <thead>
        <tr>
            <th scope="col" class="text-center color_red table_style" style="min-width: auto;">STT</th>
            <th scope="col" class="text-center color_red table_style max_content">THÔNG SỐ SẢN PHẨM</th>
            <th scope="col" class="text-center color_red table_style">ĐVT</th>
            <th scope="col" class="text-center color_red table_style">SL</th>
            <th scope="col" class="text-center color_red table_style">ĐG</th>
            <th scope="col" class="text-center color_red table_style">TT</th>
        </tr>
    </thead>
    <tbody class="fs-17 font-italic">
        @foreach ($data_products as $key => $product)
            @php
                $main_paper = getDataProExportFile($product);
            @endphp
            <tr>
                <td data-label="Sản phẩm thứ" class="table_style text-center" style="min-width: auto;">{{ $key + 1 }}</td>
                <td data-label="Nội dung" class="table_style font-italic quote_content_section max_content">
                    <p class="d-flex align-items-center mb-1 font_bold">
                        <span class="pro_name fs-18 text-uppercase">{{ @$product['name'] }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Chất liệu giấy: </span>
                        {{ getFieldDataById('name', 'materals', @$main_paper['size']['materal']) }}
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Kích thước: </span>
                        <span class="">
                            {{ getSizeTitleProduct($product) }}
                        </span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i>
                             Mẫu thiết kế : </span>
                        {{ getFieldDataById('name', 'design_types', @$product['design']) }}
                    </p>
                    <p class="d-flex align-items-center mb-1 font_bold">
                        <span class="mr-1">
                            <i class="dot"></i>
                            Công nghệ in: {{ \TDConst::PRINT_TECH[@$main_paper['print']['machine']] }}
                        </span>
                    </p>
                    <p class="mb-1">
                        <span class="font_bold mr-1"><i class="dot"></i> Hoàn thiện: </span>
                        <span class="font-italic">
                            @if (@$main_paper['nilon']['act'] == 1)
                                + Cán nilon: {{ getFieldDataById('name', 'materals', @$main_paper['nilon']['materal']).' '. $main_paper['nilon']['face'] . ' mặt ' }} 
                            @endif

                            @if (@$main_paper['compress']['act'] == 1)
                                + ép nhũ theo maket
                            @endif
                            
                            @if (@$main_paper['uv']['act'] == 1)
                                + in lưới UV {{ mb_strtolower(getFieldDataById('name', 'materals', $main_paper['uv']['materal'])) }} theo maket   
                            @endif

                            @if (!empty($main_paper['float']))
                                + thúc nổi sản phẩm
                            @endif
                        </span>
                    </p>
                    @if (!empty($main_paper['main_paper']['note']))
                        <p class="mb-1">
                            <span class="font_bold mr-1"><i class="dot"></i> Ghi chú: </span>
                            <span class="font-italic">
                                {{ $main_paper['main_paper']['note'] }}
                            </span>
                        </p>
                    @endif
                </td>
                <td data-label="DVT" class="text-center table_style">Sản phẩm</td>
                <td data-label="SL" class="text-center table_style">{{ @$product['qty'] }}</td>
                @php
                    $price = (int) $product['total_cost'];
                    $each_price = $price / (int) @$product['qty'];
                @endphp
                <td data-label="ĐG" class="text-center table_style">{{ number_format($each_price) }} đ</td>
                <td data-label="T.Tiền(VNĐ)" class="text-center table_style">{{ number_format(round($price, -3)) }} đ</td>
            </tr>
        @endforeach
    </tbody>
</table>
