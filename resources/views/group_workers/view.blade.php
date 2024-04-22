@extends('index')
@section('content')
    <div class="tab-content" id="base-tabContent">
        <div class="tab-pane show active" role="tabpanel" >
            <div class="device_list_by_supply">
                <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 mb-2 text-center">{{ @$title }}</h3>
                @foreach ($list_data as $key => $item)
                    @php
                        if (@$step == 'machine') {
                            $link = 'list-worker-by-device/device?type='.$key;
                        }else{
                            $link = 'view/w_users?default_data=%7B"type"%3A"'.@$type.'","device":"'.$key.'"%7D';
                        }
                    @endphp
                    <a href="{{ url($link) }}" class="device_supp_item">
                        {{ $item }}
                    </a>    
                @endforeach 
            </div>
        </div>
    </div>
@endsection