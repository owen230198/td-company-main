<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Loại vật tư gia công : <strong class="color_main ml-1">
        {{ !empty($supply->type) ? getSupplyNameByKey($supply->type) : @$supply->name }}.
    </strong>
</p>
<ul class="d-flex flex-wrap">
    @foreach ($all_devices as $key => $device)
        @php
            $data_stage = !empty($supply->{$key}) ? json_decode($supply->{$key}, true) : [];
        @endphp
        @if (!empty($data_stage))
            @php
                $icon = getIconByStageHandle(@$data_stage['act']);
            @endphp
            <li class="px-3 py-2 mr-2 mb-2 bg_white color_main color_{{ $icon['color'] }} box_shadow_3 radius_5">
                <i class="fa fa-{{ $icon['icon'] }} mr-1" aria-hidden="true"></i>
                {{ $device }}    
            </li>   
        @endif
    @endforeach 
</ul> 

@foreach ($data_handle as $handle)
    <p class="d-flex align-items-center color_green mb-2">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        {{ @$handle['name'] }} : <strong class="color_main ml-1">{{ $handle['value'] }}.</strong>
    </p>
@endforeach