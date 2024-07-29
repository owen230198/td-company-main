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
                                        $arr = processArrField($field);
                                        $arr['value'] = @$config_view == 1 ? @$field['value'] : @$dataItem[$field['name']];
                                        $show = true;
                                        if (!empty($arr['condition'])) {
                                            foreach ($arr['condition'] as $condtion) {
                                                $cond_name = $condtion['key'];
                                                $cond_value = $condtion['value'];
                                                if (@$dataItem->{$cond_name} != $cond_value || @$default_field[$cond_name] != $cond_value) {
                                                    $show = false;
                                                }
                                            }
                                        }
                                    @endphp
                                    @if ($show)
                                        @include('view_update.view', $arr)
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
                @include('action.list_button')
            </form>
        </div>
    @endsection
