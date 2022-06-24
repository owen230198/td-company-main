@extends('index')
@section('content')
  {!! getBreadcrumb($tableItem['name'], 0, $action_name.' '.$tableItem['note']) !!}
  <div class="dashborad_content pt-3 position-relative">
    <form action="do-{{ $action.'/'.$tableItem['name'] }}{{ @$data_item['id']?'/'.$data_item['id']:'' }}" method="POST" class="adminAjaxForm" enctype="multipart/form-data" data-table-name="{{ @$data_table_name?$data_table_name:$tableItem['name'] }}">
      @csrf
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($regions as $key => $region)
        <li class="nav-item">
          <a class="nav-link {{ $key==0?'active':'' }}" id="{{ $region['id'] }}-tab" data-toggle="tab" href="#{{ $region['id'] }}" role="tab" aria-controls="{{ $region['id'] }}" aria-selected="true">{{ $region['name'] }}</a>
        </li>
        @endforeach
      </ul>
      <div class="tab-content px-3 py-4 bg_white content_form" id="myTabContent">
        @foreach ($regions as $key => $c_region)
        <div class="tab-pane fade {{ $key==0?'show active':'' }}" id="{{ $c_region['id'] }}" role="tabpanel" aria-labelledby="{{ $c_region['id'] }}-tab">
          @foreach ($field_list as $field)
          @if ($field['region']==$c_region['id'])
            <div class="form-group d-flex mb-4 pb-4 border_bot_eb">
              <label class="mb-0 mr-3 min_150 fs-15 text-capitalize">{{ $field['note'] }}</label>
              @include('view_update.'.$field['view_type'].'',['field'=>$field, 'data'=>@$data_item?$data_item:array()])
            </div>
          @endif
          @endforeach
        </div>
        @endforeach
      </div>
      <div class="group_btn_action_form">
        <button type="submit" class="station-richmenu-main-btn-area">
          <i class="fa fa-check mr-2 fs-18" aria-hidden="true"></i>Hoàn tất
        </button>
        <a href="admin/view/{{ $tableItem['name'] }}" class="station-richmenu-main-btn-area mx-2">
          <i class="fa fa-angle-left mr-2 fs-18" aria-hidden="true"></i>Trở về
        </a>
        <a href="admin/view/{{ $tableItem['name'] }}" class="station-richmenu-main-btn-area">
          <i class="fa fa-times mr-2 fs-18" aria-hidden="true"></i>Hủy
        </a>
      </div>
    </form>
  </div>
@endsection