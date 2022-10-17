@extends('index')
@section('content')
  {!! getBreadcrumb($tableItem['name'], 0, $action_name.' '.$tableItem['note']) !!}
  <div class="dashborad_content pt-3 position-relative">
    <form action="do-{{ $action.'/'.$tableItem['name'] }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" class="actionForm" enctype="multipart/form-data" data-table-name="{{ @$data_table_name?$data_table_name:$tableItem['name'] }}">
      @csrf
      
      <div class="group_btn_action_form">
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