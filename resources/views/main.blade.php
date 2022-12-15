@extends('index')
@section('content')
    <div class="home_index">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-6">
                <a href="" class="main_item_command h-100 smooth d-flex align-items-center">
                    <img src="{{ asset('frontend/admin/images/order_icon.png') }}" alt="order-icon" class="command_icon mr-2">
                    <div class="command_detail">
                        <p class="command_detail_tiltle mb-1 fs-14">
                            Đơn hàng chưa duyệt
                        </p>
                        <p class="color_red font_bold mb-2 fs-16">200</p>
                        <p class="border_top_eb py-2">Xem chi tiết</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection