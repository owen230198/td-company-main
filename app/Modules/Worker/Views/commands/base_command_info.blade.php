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
                    {{ getTextStageDevice($device) }}    
                </li>    
            @endif
        @endif
    @endforeach 
</ul> 
@if (!empty($supply->type))
    @include('Worker::commands.info_item', ['note' => 'Loại vật tư', 'value' => getTextSupply($supply->type)])
@endif
@if (!empty($supply->ext_name))
    @include('Worker::commands.info_item', ['note' => 'Tên phụ', 'value' => getFieldDataById('name', 'paper_extends', $supply->ext_name)])
@endif
@if (!empty($supply->base_supp_qty))
    @include('Worker::commands.info_item', ['note' => 'SL tốt cần', 'value' => $supply->base_supp_qty])
@endif
@if (!empty($supply->supp_qty))
    @include('Worker::commands.info_item', ['note' => 'Tổng SL vật tư', 'value' => $supply->supp_qty])
@endif
@if (!empty($data_size['qtv']))
    @include('Worker::commands.info_item', ['note' => 'Loại giấy', 'value' => getFieldDataById('name', 'supply_prices', $data_size['qtv'])])
@endif
@if (!empty($data_size['length']) && !empty($data_size['width']))
    @include('Worker::commands.info_item', ['note' => 'Kích thước sx', 'value' => $data_size['length'] . ' x ' . $data_size['width']])
@endif
@foreach ($data_handle as $handle)
    <p class="d-flex align-items-center color_green mb-2">
        <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
        {{ @$handle['name'] }} : <strong class="color_main ml-1">{{ $handle['value'] }}.</strong>
    </p>
@endforeach