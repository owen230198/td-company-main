@if (@$button['type'] == 2)
    <button type="button" class="table-btn mr-2 mb-2 {{ @$button['class'] }}" title="{{ @$button['note'] }}" data-table="{{ $tableItem['name'] }}" data-id="{{ $data->id }}">
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </button>
@else
    @php
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
    </a>
@endif