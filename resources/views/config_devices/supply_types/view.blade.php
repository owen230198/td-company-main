@extends('index')
@section('content')
<div class="base_content_view">
    <div class="header_chose_supp_device">
        <ul class="nav nav-pills mb-3 base_nav_link" id="base-tab" role="tablist">
            @if (@$type == 'devices')
                @foreach ($supply as $key => $item)
                    @if (!empty($item['device']))
                        <li class="nav-item">
                            <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="{{ $item['pro_field'] }}-tab" data-toggle="pill" 
                            href="#{{ $item['pro_field'] }}" role="tab" aria-controls="{{ $item['pro_field'] }}" aria-selected="true">
                            {{ $item['note'] }}</a>
                        </li>
                    @endif
                @endforeach
            @else
                @foreach ($supply as $key => $item)
                    <li class="nav-item">
                        <a class="nav-link{{ $key == 0 ? ' active' : '' }}" id="{{ $item['pro_field'] }}-tab" data-toggle="pill" 
                        href="#{{ $item['pro_field'] }}" role="tab" aria-controls="{{ $item['pro_field'] }}" aria-selected="true">
                        {{ $item['note'] }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="tab-content" id="base-tabContent">
            @foreach ($supply as $key => $item)
                <div class="tab-pane fade{{ $key == 0 ? ' show active' : '' }}" id="{{ $item['pro_field'] }}" role="tabpanel" 
                aria-labelledby="base-{{ $item['pro_field'] }}-tab">
                    @if (@$type == 'devices')
                        @if (!empty($item['device']))
                            <div class="device_list_by_supply">
                                {{-- <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 mb-2 text-center">ĐG thiết bị máy</h3> --}}
                                @foreach ($item['device'] as $key_device => $device)
                                    @php
                                        $link = $key_device == \TDConst::PRINT ? 'config-device-price/print_techs' 
                                        : 'view/devices?supply='.$item['pro_field'].'&key_device='.$key_device;
                                    @endphp
                                    <a href="{{ url($link) }}" class="device_supp_item">{{ $device }}</a>    
                                @endforeach 
                            </div>
                        @endif
                    @else
                    @php
                        $materal_supplies = !empty(\TDConst::MATERAL_SUPPLY_TYPE[$item['pro_field']]) ? \TDConst::MATERAL_SUPPLY_TYPE[$item['pro_field']] : [];
                    @endphp
                    @if (!empty($materal_supplies))
                        <div class="device_list_by_supply">
                            {{-- <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 mb-2 text-center">ĐG Chất liệu & vật tư</h3> --}}
                            @foreach ($materal_supplies as $materal_supply)
                                <a href="{{ url('view/'.$materal_supply['table'].'?type='.$materal_supply['key']) }}" class="device_supp_item">
                                    {{ $materal_supply['name'] }}
                                </a>    
                            @endforeach 
                        </div>
                    @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection