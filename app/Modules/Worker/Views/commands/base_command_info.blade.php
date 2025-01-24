<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Tên vật tư gia công : <strong class="color_main ml-1">
        {{ $data_command->name }}.
    </strong>
</p>
@if (!empty($supply->type))
    <p class="d-flex align-items-center color_green mb-2">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        loại vật tư  : <strong class="color_main ml-1">
            {{ getTextSupply($supply->type) }}.
        </strong>
    </p>
@endif
<ul class="d-flex flex-wrap">
    @foreach ($all_devices as $device)
        @php
            $data_stage = !empty($supply->{$device}) ? json_decode($supply->{$device}, true) : [];
        @endphp
        @if (!empty($data_stage) && !empty($data_stage['machine']))
            @php
                $icon = getIconByStageHandle(@$data_stage['act']);
            @endphp
            @if (@$icon['color'] != 'red')
                <li class="px-3 py-2 mr-2 mb-2 bg_white color_main color_{{ $icon['color'] }} box_shadow_3 radius_5">
                    <i class="fa fa-{{ $icon['icon'] }} mr-1" aria-hidden="true"></i>
                    {{ getFieldDataById('name', 'devices', $data_stage['machine']) }}    
                </li>    
            @endif
        @endif
    @endforeach 
</ul> 

@foreach ($data_handle as $handle)
    <p class="d-flex align-items-center color_green mb-2">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        {{ @$handle['name'] }} : <strong class="color_main ml-1">{{ $handle['value'] }}.</strong>
    </p>
@endforeach