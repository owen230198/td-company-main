@extends('index')
@section('content')
<div class="base_content_view">
    <div class="header_chose_supp_device">
        <ul class="nav nav-pills mb-3 base_nav_link" id="base-tab" role="tablist">
            @foreach ($supply as $key => $item)
                @if (!empty($item['device']))
                    <li class="nav-item">
                        <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="{{ $item['pro_field'] }}-tab" data-toggle="pill" 
                        href="#{{ $item['pro_field'] }}" role="tab" aria-controls="{{ $item['pro_field'] }}" aria-selected="true">{{ $item['note'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="tab-content" id="base-tabContent">
            @foreach ($supply as $key => $item)
                @if (!empty($item['device']))
                    <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }}" id="{{ $item['pro_field'] }}" role="tabpanel" 
                    aria-labelledby="base-{{ $item['pro_field'] }}-tab">
                        <div class="device_list_by_supply">
                            @foreach ($item['device'] as $key => $device)
                                <a href="{{ url('config-device-price/devices?supply='.$item['pro_field'].'&key_device='.$key.'&name='.$device) }}" 
                                class="device_supp_item">
                                    {{ $device }}
                                </a>    
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection