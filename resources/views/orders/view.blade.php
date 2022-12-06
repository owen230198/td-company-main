@extends('index')
@section('content')
    <div class="dashborad_content position-relative p-3 bg_white">
        <form action="{{ $action }}-orders{{ $action==\App\Constants\VariableConstant::ACTION_UPDATE?
        '/'.@$dataItemOrder['id']:'' }}" method="POST" class="actionForm {{ $action }}_order_form baseAjaxForm" 
        enctype="multipart/form-data" lang="vi">
            @csrf
            <div class="form_order_action">
                <div class="order_base_input row justify-content-center">
                    @foreach ($field_list as $field)
                        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
                            <label class="mb-0 mr-3 w_150 fs-13 text-capitalize">{{ $field['note'] }}</label>
                            @include('view_update.'.$field['view_type'], ['field' => $field, 'data' => @$dataItemOrder??[]])
                        </div>
                    @endforeach
                    @include('orders.field_actions')
                </div>
                <div class="ajax_product_orders mt-4 pt-4 list_product_order">

                </div>
            </div>
            <div class="group_btn_action_form p-1 mt-3">
                <button type="submit" class="station-richmenu-main-btn-area">
                    <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>{{ getActionByKey($action) }}
                </button>
                @if ($action == \App\Constants\VariableConstant::ACTION_UPDATE)
                <button type="button" class="station-richmenu-main-btn-area">
                    <i class="fa fa-print mr-2 fs-14" aria-hidden="true"></i>In đơn hàng
                </button>
                <a href="" class="station-richmenu-main-btn-area">
                    <i class="fa fa-file-text-o mr-2 fs-14" aria-hidden="true"></i>Tạo phiếu chi
                </a>      
                @endif
                <a href="{{ @session()->get('back_url') ? session()->get('back_url') : '' }}"
                    class="station-richmenu-main-btn-area">
                    <i class="fa fa-chevron-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
            </div>
        </form>
        @if ($action == \App\Constants\VariableConstant::ACTION_UPDATE)
            <div class="my-4">
                <h2 class="station-richmenu-main__ttl text-capitalize mb-3 fs-18">Danh sách sản phẩm trong đơn hàng</h2>
                @include('table.table_base_view', ['field_shows'=>@$dataViewProductList['field_shows'], 
                'tableItem'=>@$dataViewProductList['tableItem'], 'data_tables'=>@$listDataProduct, 'hideCheck'=>true])
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
