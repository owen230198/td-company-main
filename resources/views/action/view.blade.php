@extends('index')
@section('content')
<div class="dashborad_content pt-3 position-relative">
  <form action="{{ asset('do-'.$action.'/'.$tableItem['name'].'') }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" class="adminAjaxForm" enctype="multipart/form-data" data-table-name="{{ $tableItem['name'] }}">
    @csrf
    <div class="px-3 py-4 bg_white content_form">
        @foreach ($feild_updates as $field)
           <div class="form-group d-flex mb-4 pb-4 border_bot_eb">
            <label class="mb-0 mr-3 min_150 fs-15 text-capitalize">{{ $field['note'] }}</label>
            @include('view_update\\'.$field['view_type'].'', array('field'=>$field, 'data'=>@$dataitem?$dataitem:array()))
          </div>
        @endforeach
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