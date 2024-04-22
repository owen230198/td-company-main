@if (@$button['type'] == 2)
    <button type="button" 
    class="main_button color_white bg_green border_green radius_5 mr-3 font_bold smooth {{ @$button['class'] }}" 
    title="{{ @$button['note'] }}" 
    data-table="{{ $tableItem['name'] }}" 
    data-id="{{ @$dataItem['id'] }}">
        <i class="fa fa-{{ $button['icon'] }} mr-2 fs-14" aria-hidden="true"></i>
        {{ @$button['note'] }}
    </button>
@else
    {{-- @php
        $link = $button['link'];
        if (str_contains($link, '<id>') || str_contains($link, '<table>')) {
            if (str_contains($link, '<id>')) {
                $link = str_replace('<id>', $data->id, $link);
            }
            if (str_contains($link, '<table>')) {
                $link = str_replace('<table>', $tableItem['name'], $link);
            }
        }else{
            $link = $link.''.$data->id;    
        }
    @endphp
    <a href="{{ url(@$link) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}">
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </a> --}}
@endif