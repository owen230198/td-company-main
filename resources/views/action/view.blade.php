@extends('index')
@section('content')
  <div class="dashborad_content position-relative">
    <form action="do-{{ $action.'/'.$tableItem['name'] }}{{ @$dataitem['id']?'/'.$dataitem['id']:'' }}" method="POST" 
    class="actionForm config_content" enctype="multipart/form-data" data-table-name="{{ @$data_table_name?$data_table_name:$tableItem['name'] }}">
      @csrf
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($regions as $key => $region)
        <li class="nav-item">
          <a class="nav-link {{ $key==0?'active':'' }}" id="{{ $region['id'] }}-tab" data-toggle="tab" href="#{{ $region['id'] }}" role="tab" aria-controls="{{ $region['id'] }}" aria-selected="true">{{ $region['name'] }}</a>
        </li>
        @endforeach
      </ul>
      <div class="tab-content px-2 py-3 bg_white content_form" id="myTabContent">
        @foreach ($regions as $key => $c_region)
        <div class="tab-pane fade {{ $key==0?'show active':'' }}" id="{{ $c_region['id'] }}" role="tabpanel" aria-labelledby="{{ $c_region['id'] }}-tab">
          @foreach ($field_list as $field)
            @if ($field['region']==$c_region['id'])
              @php
                $arr = $field;
                $arr['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                $arr['value'] = @$dataitem[$field['name']];
              @endphp
            @include('view_update.view', $arr)
            @endif
          @endforeach
        </div>
        @endforeach
      </div>
      <div class="group_btn_action_form text-center">
        <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
          <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <a href="{{ @session()->get('back_url') ?? '' }}" class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
            <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
        </a>
        <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
          <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
      </div>
    </form>
  </div>
@endsection