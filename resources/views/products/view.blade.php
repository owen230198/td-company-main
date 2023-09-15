@extends('index')
@section('content')
    <div class="dashborad_content">
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
            @php
                $admins = new \App\Services\AdminService;
                $table_arr = $admins->getBaseTable($element['table']);
                $table_arr['data_tables'] = $element['data'];
            @endphp
            @if (!empty($element['data']))
                <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="element-{{ $element['key'] }}" role="tabpanel" aria-labelledby="element-{{ $element['key'] }}-tab">
                    @include('table.table_base_view', $table_arr)    
                </div>
            @endif
        @endforeach
    </div>
@endsection
