@extends('index')
@section('content')
    <div class="dashborad_content position-relative p-3 bg_white">
        <form action="insert-orders" method="POST" class="actionForm baseAjaxFor" enctype="multipart/form-data" lang="vi">
            @csrf
            <div class="form_order_action">
                <div class="order_base_input row justify-content-center">
                    @foreach ($field_list as $field)
                        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                            <label class="mb-0 mr-3 w_125 fs-13 text-capitalize">{{ $field['note'] }}</label>
                            @include('view_update.' . $field['view_type'] . '', [
                                'field' => $field,
                                'data' => @$dataitem ? $dataitem : [],
                            ])
                        </div>
                    @endforeach
                    @include('orders.field_actions')
                </div>
                <div class="ajax_product_orders mt-4 pt-4 list_product_order">
                  
                </div>
            </div>
            <div class="group_btn_action_form p-1 mt-3">
                <button type="submit" class="station-richmenu-main-btn-area">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
                </button>
                <a href="{{ @session()->get('back_url') ? session()->get('back_url') : '' }}"
                    class="station-richmenu-main-btn-area mx-2">
                    <i class="fa fa-chevron-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="{{ @session()->get('back_url') ? session()->get('back_url') : '' }}"
                    class="station-richmenu-main-btn-area">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
