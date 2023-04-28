@extends('index')
@section('content')
<div class="base_content_view">
    <div class="device_list_by_supply">
        @foreach ($supply as $key => $tech)
            <a href="{{ url('view/printers?device='.$key) }}" class="device_supp_item">
                {{ $tech }}
            </a>    
        @endforeach
    </div>
@endsection