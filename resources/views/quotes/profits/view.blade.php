@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="position-relative">
        <div class="quote_table_stage mb-4">
            <table class="table table-bordered mb-1">
                <thead>
                    <tr>
                        <th class="w_50">#</th>
                        <th>Sản phẩm</th>
                        @foreach ($supply_fields as $th)
                            <th>{{ @$th['note'] }}</th>    
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td class="w_50">{{ $key + 1 }}</td>
                            <td>{{ $product['name'] }}</td>
                            @php
                                $supply_product = isHardbox($product['category']) ? $supply_fields : \TDConst::PAPER_ELEMENT;
                            @endphp
                            @foreach ($supply_product as $supply)
                                <td>
                                    @php
                                        $where = ['act' => 1, 'product' => $product['id']];
                                        if ($supply['table'] == 'supplies') {
                                            $where['type'] = $supply['pro_field'];
                                        }
                                        $data_supply = \DB::table($supply['table'])->where($where)->get()->toArray();
                                        if (!empty($supply['device'])) {
                                            $supply['device']['size'] = 'vật tư';
                                            if ($supply['table'] == 'papers') {
                                                $supply['device']['print'] = 'máy in';
                                            }
                                        }else{
                                            $supply['device'] = \TDConst::FILL_FINISH_STAGE;   
                                        }
                                    @endphp
                                    <ul class="list_supplies">
                                        @foreach ($data_supply as $key_supp => $item)
                                            @include('quotes.profits.item')
                                        @endforeach
                                    </ul> 
                                </td> 
                            @endforeach
                        </tr>     
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="{{ asset('profit-config-quote') }}" method="POST" class="baseAjaxForm config_content" enctype="multipart/form-data">
            @csrf
            @php
                $ship_price_input = [
                            'name' => 'ship_price',
                            'note' => 'Chi phí vận chuyển',
                            'attr' => ['type_input' => 'number', 'required' => 1],
                        ]; 
                $profit_input = [
                    'name' => 'profit',
                    'note' => 'Lợi nhuận (%)',
                    'attr' => ['type_input' => 'number', 'required' => 1],
                ];
            @endphp
            @include('view_update.view', $ship_price_input)
            @include('view_update.view', $profit_input) 
            <div class="group_btn_action_form text-center">
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="{{ url('') }}" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Thoát
                </a>
            </div> 
        </form>
        <div class="quote_total_cost">
            <h3 class="font_bold fs-18 color_red mb-0">BỘ SẢN PHẨM BAO GỒ COMBO {{ count($products) }} SẢN PHẨM - TỔNG GIÁ : {{ number_format((int) @$data_quote['total_amount']) }} đ</h3>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/quote.js') }}"></script>
@endsection
