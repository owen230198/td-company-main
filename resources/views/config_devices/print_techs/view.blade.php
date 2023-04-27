@extends('index')
@section('content')
<div class="base_content_view">
    <div class="device_list_by_supply">
        @foreach ($supply as $key => $tech)
            <a href="{{ url('config-device-price/printers?table=printers&device='.$key.'&name='.$tech) }}" class="device_supp_item">
                {{ $tech }}
            </a>    
        @endforeach
    </div>
@endsection