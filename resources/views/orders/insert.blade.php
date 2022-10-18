@extends('index')
@section('content')
  <div class="dashborad_content position-relative p-3 bg_white">
    <form action="insert-orders" method="POST" class="actionForm" enctype="multipart/form-data" data-table-name="{{ @$data_table_name?$data_table_name:$tableItem['name'] }}">
      @csrf
      <div class="form_order_action row justify-content-center">
        @foreach ($field_list as $field)
          <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
            <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">{{ $field['note'] }}</label>
            @include('view_update.'.$field['view_type'].'',['field'=>$field, 'data'=>@$dataitem?$dataitem:array()])
          </div>
        @endforeach
        <div class="form-group mb-3 pb-3 border_bot_eb vat_cost_group_input d_flex col-4" style="display: none">
          <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">VAT(%)</label>
          <input type="number" class="form-control" name="order[vat_cost]" value="">
        </div>
        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
          <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">Tiền hàng</label>
          <input type="number" class="form-control disable_field" name="order[product_cost]" value="">
        </div>
        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
          <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">Tổng tiền</label>
          <input type="number" class="form-control disable_field" name="order[total_cost]" value="">
        </div>
        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
          <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">Tạm ứng</label>
          <input type="number" class="form-control" name="order[advance_cost]" value="">
        </div>
        <div class="form-group d-flex mb-3 pb-3 border_bot_eb col-4">
          <label class="mb-0 mr-3 min_25 fs-13 text-capitalize">Còn lại</label>
          <input type="number" class="form-control disable_field" name="order[rest_cost]" value="">
        </div>
      </div>
      <div class="group_btn_action_form position-relative">
        <button type="submit" class="station-richmenu-main-btn-area">
          <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <a href="{{ @session()->get('back_url')?session()->get('back_url'):'' }}" class="station-richmenu-main-btn-area mx-2">
          <i class="fa fa-chevron-left mr-2 fs-14" aria-hidden="true"></i>Trở về
        </a>
        <a href="{{ @session()->get('back_url')?session()->get('back_url'):'' }}" class="station-richmenu-main-btn-area">
          <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection