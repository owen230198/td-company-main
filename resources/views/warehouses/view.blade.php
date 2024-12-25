@extends('index')
@section('content')
<div class="base_content_view">
    <div class="supply_list">
        @foreach ($supply_list as $supply)
            @php
                $param = @$supply['type'] != \TDConst::OTHER_SUPPLY ? '%7B"type"%3A"'.$supply['type'].'","status":"imported"%7D' : '%7B"status":"imported"%7D';
                $url = 'view/'.$supply['table'].'?default_data='.$param;
            @endphp
            <a href="{{ url($url) }}" class="device_supp_item">
                {{ @$supply['note'] }}
            </a>    
        @endforeach
    </div>
@endsection