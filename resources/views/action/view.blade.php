@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($regions as $key => $region)
                    <li class="nav-item">
                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $region['id'] }}-tab" data-toggle="tab"
                            href="#{{ $region['id'] }}" role="tab" aria-controls="{{ $region['id'] }}"
                            aria-selected="true">{{ $region['name'] }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content px-2 py-3 bg_white content_form" id="myTabContent">
                @if (!empty($default_field))
                    @foreach ($default_field as $key => $df_value)
                        <input type="hidden" name = "{{ $key }}" value = "{{ $df_value }}">   
                    @endforeach
                @endif
                @foreach ($regions as $key => $c_region)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $c_region['id'] }}"
                        role="tabpanel" aria-labelledby="{{ $c_region['id'] }}-tab">
                        @foreach ($field_list as $field)
                            @php
                                $field =  (array) $field;
                            @endphp
                            @if ($field['region'] == $c_region['id'])
                                @php
                                    $arr = $field;
                                    $arr['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                                    $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                                    $arr['value'] = @$config_view == 1 ? @$field['value'] : @$dataItem[$field['name']];
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
                <a href="{{ getBackUrl() }}"
                    class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                    <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
                </a>
                <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                    <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
                </a>
            </div>
        </form>
    </div>
@endsection
