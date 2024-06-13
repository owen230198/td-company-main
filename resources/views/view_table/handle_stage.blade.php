@php
    $stage = !empty($value) ? json_decode($value, true) : [];
    $icon = getIconByStageHandle(@$stage['act']);
@endphp
@if ($history_view)
    @php
        $data_stages = \App\Models\WSalary::getHandleDataJson($name, $stage, true, true);
        dump($stage);
    @endphp
    @if (!empty($data_stages))
        <div class="p-2 box_shadow_3 radius_5">
            @foreach ($data_stages as $data_stage)
                <p class="d-flex align-items-center color_green mb-1 w_max_content">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    {{ $data_stage['name'] }} : {{ $data_stage['value'] }}.
                </p> 
            @endforeach
        </div>
    @endif
@else
    <div class="handle_stage_item color_white bg_{{ $icon['color'] }} box_shadow_3">
        <i class="fa fa-{{ $icon['icon'] }} mr-1" aria-hidden="true"></i>    
    </div> 
@endif 