@extends('index')
@section('content')
<div class="base_content_view">
    <div class="supply_list">
        @foreach ($supply_list as $supply)
            <a href="{{ url('view/'.$supply['table'].'?default_data={"type":"'.$supply['type'].'","status":"imported"}') }}" class="device_supp_item">
                {{ @$supply['note'] }}
            </a>    
        @endforeach
    </div>
@endsection