@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content config_content base_content p-0 mb-5">
        <form action="{{ url('order-delivery/'.$order->id) }}" method="POST" class="mb-0 baseAjaxForm">
            @csrf
            <div class="mb-3 text-center">
                <p class="text-uppercase fs-16 font_bold color_green pt-4">Chứng từ bán hàng</p>
                <p class="d-flex align-items-center fs-12 font-italic justify-content-center"><span class="d-block">Đơn hàng</span>  : <span class="color_red ml-1 font_bold">{{ $order->code }}</span></p>
            </div>
            <div class="row row-5">
                <div class="col-9">
                    @foreach ($customer_infos as $infor)
                        @include('view_info', $infor)     
                    @endforeach
                </div>
                <div class="col-3">
                    @foreach ($document_infos as $infor)
                        @include('view_info', $infor)     
                    @endforeach
                </div>
            </div>
            <div class="print_product_table my-4">
                <table class="table table-bordered mb-1">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Sản phẩm</th>
                            <th scope="col">SL đặt</th>
                            <th scope="col">Còn phải xuất</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="__cost_c_order_module">
                        @foreach ($products as $key => $product)
                            <tr class="__item_json">
                                @php
                                    $product_warehouse = getDetailDataObject('product_warehouses', $product->product_warehouse);
                                    $obj_name = "object[$key]";
                                    $price = @$product_warehouse->price ?? $product->total_amount/$product->qty;
                                    $product_amount = $price*$product->delivery;
                                    $deliver_total += $product_amount;
                                @endphp
                                <td scope="row">{{ $key + 1 }}</td>
                                <td>
                                    <input type="hidden" name="{{ $obj_name.'[id]' }}" value="{{ @$product_warehouse->id }}">
                                    {{ @$product_warehouse->name ?? $product->name }}
                                </td>
                                <td>{{ $product->qty }}</td>
                                <td class="text-center">
                                    <input 
                                        type="number" name="{{ $obj_name.'[qty]' }}" 
                                        class="form-control border-none price_input mx-auto radius_5 __selling_input_count_item __selling_qty_input_item" 
                                        placeholder="SL còn phải xuất" value="{{ $product->delivery }}">
                                </td>
                                <td class="text-center">
                                    <div class="price_input_module">
                                        <input type="hidden" class="price_input_value" value="0" name="{{ $obj_name.'[price]' }}">
                                        <input class="form-control font_bold price_input_label border-none price_input price_input_label ml-auto __selling_input_count_item __selling_price_input_item" 
                                            type="text" value="{{ number_format($price) }}"> 
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="price_input_module">
                                        <input type="hidden" class="price_input_value" value="{{ $product_amount }}" name="{{ $obj_name.'[total]' }}">
                                        <input class="border-none bg_none font_bold price_input_label __selling_total_item_input" type="text" value="{{ number_format($product_amount) }}" readonly> 
                                    </div>
                                </td>
                            </tr>    
                        @endforeach
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Chi phí khác</p></td>
                            <td class="text-right">
                                <div class="price_input_module">
                                    <input type="hidden" class="price_input_value" value="0" name="other_price">
                                    <input 
                                        class="form-control font_bold price_input_label border-none price_input price_input_label ml-auto __selling_input_count __selling_other_price_input" 
                                        type="text" value="" placeholder="Chi phí khác"> 
                                </div>
                            </td>
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Tiền hàng</p></td>
                            <td class="text-right">
                                <div class="price_input_module">
                                    <input type="hidden" class="price_input_value" value="{{ $deliver_total }}" name="total">
                                    <input class="border-none bg_none font_bold price_input_label __selling_total_input" 
                                        type="text" value="{{ number_format($deliver_total) }}" readonly> 
                                </div>
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Thanh toán</p></td>
                            <td class="text-right">
                                <div class="price_input_module">
                                    <input type="hidden" class="price_input_value" value="0" name="advance">
                                    <input 
                                        class="form-control font_bold price_input_label border-none price_input price_input_label ml-auto __selling_input_count __selling_advance_input" 
                                        type="text" value="" placeholder="Thanh toán"> 
                                </div>
                            </td>
                        </tr>
                        <tr class="bg_pink">
                            <td colspan="5"><p class="text-right mr-3">Thành tiền bằng số</p></td>
                            <td class="text-right">
                                <div class="price_input_module">
                                    <input type="hidden" class="price_input_value" value="{{ $deliver_total }}" name="rest">
                                    <input class="border-none bg_none font_bold price_input_label __selling_rest_input" 
                                        type="text" value="{{ number_format($deliver_total) }}" readonly> 
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('view_update.view', $field_note)
            <div class="group_btn_action_form text-center w-100">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <button type="button" class="main_button bg_red color_white radius_5 font_bold smooth red_btn close_action_popup">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </button>
            </div>
        </form>  
    </div>
@endsection
