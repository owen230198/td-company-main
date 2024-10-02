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
                    @php
                        $time_fields = [
                            [
                                'name' => 'created_at',
                                'attr' => ['inject_class' => 'price_input'],
                                'min_label' => 120,
                                'note' => 'Ngày hạch toán',
                                'type' => 'datetime',
                            ],
                            [
                                'name' => 'created_at',
                                'attr' => ['inject_class' => 'price_input'],
                                'min_label' => 120,
                                'note' => 'Ngày chứng từ',
                                'type' => 'datetime',
                            ],
                        ]
                    @endphp
                    @foreach ($time_fields as $time_field)
                        @include('view_update.view', $time_field)    
                    @endforeach
                    @foreach ($document_infos as $key => $infor)
                        @include('view_info', $infor)     
                    @endforeach
                </div>
            </div>
            <div class="print_product_table my-4">
                @include('orders.deliveries.table')
            </div>
            @php
                $bill_field = [
                    'note' => 'Phiếu xuất kho',
                    'type' => 'filev2',
                    'name' => 'receipt',
                    'min_label' => 120,
                    'other_data' => ['role_update' => [\GroupUser::PRODUCT_WAREHOUSE, \GroupUser::ACCOUNTING]] 
                ]
            @endphp
            @include('view_update.view', $bill_field)
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
