<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Loại vật tư gia công : <strong class="color_main ml-1">
        {{ !empty($data_command->type) ? getSupplyNameByKey($data->command->type) : @$data_command->name }}.
    </strong>
</p>
<ul class="d-flex flex-wrap">
    @foreach ($all_devices as $key => $device)
        @php
            $data_stage = !empty($data_command->{$key}) ? json_decode($data_command->{$key}, true) : [];
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