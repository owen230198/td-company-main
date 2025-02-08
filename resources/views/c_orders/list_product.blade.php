@extends('index')
@section('content')
    <div class="dashborad_content">
        @if (count($list_data) > 0)
            <div class="table_base_view position-relative">
                <h3 class="fs-14 text-uppercase pt-4 mt-4 text-center font_bold text-center color_green">{{ $title }}</h3>
                <h3 class="fs-14 text-uppercase py-2 my-2 text-center font_bold text-center color_green">
                    Mã phiếu: {{ $dataItem->code }}
                </h3>
                <table class="table table-bordered mb-1">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Sản phẩm</th>
                            <th scope="col">Số lượng xuất</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="__cost_c_order_module">
                        @foreach ($list_data as $key => $product)
                            <tr class="__item_json">
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>
                                    {{ getFieldDataById('name', 'product_warehouses', $product->id) }}
                                </td>
                                <td>{{ $product->qty }}</td>
                                <td class="text-center">
                                    {{ $product->price }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($product->total) }}
                                </td>
                            </tr>    
                        @endforeach
                        <tr class="bg_pink">
                            <td colspan="4"><p class="text-right mr-3">Chi phí khác</p></td>
                            <td class="text-right">
                                {{ number_format($dataItem->other_price) }}
                            </td>
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="4"><p class="text-right mr-3">Tiền hàng</p></td>
                            <td class="text-right">
                                {{ number_format($dataItem->total) }}
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="4"><p class="text-right mr-3">Thanh toán</p></td>
                            <td class="text-right">
                                {{ number_format($dataItem->advance) }}
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="4"><p class="text-right mr-3">Thành tiền bằng số</p></td>
                            <td class="text-right">
                                {{ number_format($dataItem->rest) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="fs-15 font-italic color_red">Chưa có dữ liệu {{ @$title }} !</p>
        @endif
    </div>
@endsection