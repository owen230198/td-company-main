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
                    @if (!empty($main_paper['print']))
                        <p class="d-flex align-items-center mb-1 font_bold">
                            <span class="mr-1">
                                <i class="dot"></i>
                                Công nghệ in: {{ \TDConst::PRINT_TECH[@$main_paper['print']['machine']] }}
                            </span>
                        </p>    
                    @endif
                    @php
                        $finish_info = getTextQuoteFinish($main_paper)
                    @endphp
                    @if (!empty($finish_info))
                        <p class="mb-1">
                            <span class="font_bold mr-1"><i class="dot"></i> Hoàn thiện: </span>
                            <span class="font-italic">
                                {{ $finish_info }}    
                            </span>
                        </p>
                    @endif
                    @if (!empty($product['detail']))
                        <p class="mb-1">
                            <span class="font_bold mr-1"><i class="dot"></i> Ghi chú: </span>
                            <span class="font-italic">
                                {{ $product['detail'] }}
                            </span>
                        </p>
                    @endif
                </td>
                <td data-label="DVT" class="text-center table_style">Sản phẩm</td>
                <td data-label="SL" class="text-center table_style">{{ @$product['qty'] }}</td>
                @php
                    $each_price = (int) $product['total_amount'] / (int) @$product['qty']
                @endphp
                <td data-label="ĐG" class="text-center table_style">{{ number_format($each_price) }} đ</td>
                <td data-label="T.Tiền(VNĐ)" class="text-center table_style">{{ number_format(ceil($each_price * @$product['qty'])) }} đ</td>
            </tr>
        @endforeach
    </tbody>
</table>
