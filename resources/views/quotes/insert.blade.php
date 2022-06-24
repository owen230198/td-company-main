@extends('index')
@section('content')
<div class="dashborad_content pt-3 position-relative">
  <form action="{{ asset('do-action-table-'.$action.'/'.'orders') }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" class="adminAjaxForm" enctype="multipart/form-data" data-table-name="{{ $tableItem['name'] }}">
    @csrf
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id=" customer-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="true">Thông tin khách hàng</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id=" quotes-tab" data-toggle="tab" href="#quotes" role="tab" aria-controls="quotes" aria-selected="true">Thông tin báo giá</a>
      </li>
    </ul>
    <div class="tab-content px-3 py-4 bg_white content_form" id="myTabContent">
      <div class="tab-pane fade active" id="customer" role="tabpanel" aria-labelledby="customer-tab">
        <div class="form-group d-flex mb-4 pb-4 border_bot_eb">
          <label class="mb-0 mr-3 min_150 fs-15 text-capitalize">Chọn khách hàng</label>
          <div class="d-flex align-items-center w-100">
            <select name="customer_id" class="form-control">
              <option value="0">Không xác định</option>
               @foreach ($list_option as $key => $option)
                @if (@$default_data->model)
                <option value="{{ $option['id'] }}" {{ $value==$option['_id']?'selected':'' }}>
                    {{ $option['name'] }}
                  </option>
                @else
                <option value="{{ $key }}" {{ $value==$key?'selected':'' }}>
                  {{ $option }}
                </option>
                @endif
               @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="group_btn_action_form">
      <button type="submit" class="station-richmenu-main-btn-area">
        <i class="fa fa-check mr-2 fs-18" aria-hidden="true"></i>Hoàn tất
      </button>
      <a href="{{ asset('view/'.$tableItem['name'].'') }}" class="station-richmenu-main-btn-area mx-2">
        <i class="fa fa-angle-left mr-2 fs-18" aria-hidden="true"></i>Trở về
      </a>
      <a href="{{ asset('view/'.$tableItem['name'].'') }}" class="station-richmenu-main-btn-area">
        <i class="fa fa-times mr-2 fs-18" aria-hidden="true"></i>Hủy
      </a>
    </div>
  </form>
</div>
@endsection