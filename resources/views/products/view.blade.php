@extends('index')
@section('content')
    <div class="base_page h-100">
        <div class="page_content">
            <div class="dashborad_content p-3">
                <ul class="nav nav-pills mb-3 quote_pro_strct_nav_link" id="element-tab" role="tablist">
                    @foreach ($elements as $key => $element)
                        @if (!empty($element['data']))
                            <li class="nav-item">
                                <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="element-{{ $element['key'] }}-tab" data-toggle="pill" href="#element-{{ $element['key'] }}" 
                                role="tab" aria-controls="element-{{ $element['key'] }}" aria-selected="true">{{ $element['note'] }}</a>
                            </li>   
                        @endif
                    @endforeach
                </ul>  
            </div>
            <div class="tab-content" id="element-tabContent">
                @foreach ($elements as $key => $element)
                    @if (!empty($element['data']))
                        @php
                            $admins = new \App\Services\AdminService;
                            $element_table = $element['table'];
                            $table_arr = $admins->getBaseTable($element_table);
                            $table_arr['data_tables'] = $element['data'];
                            $arr_field = $admins->getFieldAction($element_table);
                            $table_arr['rowspan'] = $arr_field['rowspan'];
                            $table_arr['field_shows'] = $arr_field['field_shows'];
                        @endphp
                        <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="element-{{ $element['key'] }}" role="tabpanel" aria-labelledby="element-{{ $element['key'] }}-tab">
                            <div class="text-center mb-3">
                                <a href="{{ url('print-data/products/'.$product_id.'?table='.$element['table'].'&type='.$element['pro_field']) }}" target="_blank" class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-2">
                                    <i class="fa fa-book mr-2 fs-15" aria-hidden="true"></i>In lệnh
                                </a>
                            </div>
                            @include('table.table_base_view', $table_arr)    
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
