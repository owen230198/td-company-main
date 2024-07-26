@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            <div class="__c_supply_warehouse">
                <div class="__type_supply_select">
                    @foreach ($field_type as $field)
                        @php
                            $name = $field['name'];
                            $arr = processArrField($field);
                            $arr['value'] = @$dataItem[$name];
                        @endphp
                        @include('view_update.view', $arr)
                    @endforeach
                </div>
                <div class="__ajax_qty_type">
                    @if (!empty($dataItem['qty']) && !empty($dataItem['supp_type']))
                        @include('view_update.c_supply_qty', ['type' => $dataItem['supp_type'], 'value' => $dataItem['qty']])
                    @endif
                </div>
                @foreach ($field_action as $action)
                    @php
                        $name = $action['name'];
                        $arr = processArrField($action);
                        $arr['value'] = @$dataItem[$name];
                    @endphp
                    @include('view_update.view', $arr)
                @endforeach
            </div>
            <div class="group_btn_action_form text-center">
                <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth">
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