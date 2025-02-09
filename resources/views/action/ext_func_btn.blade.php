@php
    $link_ext_btn = getDataLinkButton($button['link'], $dataItem);
@endphp
@if (@$button['type'] == 2)
    <button type="button" 
        class="main_button color_white bg_green border_green radius_5 mr-3 font_bold smooth {{ @$button['class'] }}" 
        title="{{ @$button['note'] }}" 
        data-table="{{ $tableItem['name'] }}" 
        data-id="{{ @$dataItem['id'] }}"
        @if (!empty($button['datas']))
            @foreach ($button['datas'] as $dt)
                @if (!empty($dataItem->{$dt}))
                    {!! "data-".$dt."='".$dataItem->{$dt}."'"  !!}
                @endif
            @endforeach
        @endif
        @if (!empty($link_ext_btn))
            {!! "data-src=$link_ext_btn" !!} 
            data-toggle="modal" 
            data-target="#actionModal" 
            @if (!empty($button['size_popup']))
                data-size="{{ $button['size_popup'] }}"
            @endif
        @endif
    >
        <i class="fa fa-{{ $button['icon'] }} mr-2 fs-14" aria-hidden="true"></i>
        {{ @$button['note'] }}
    </button>
@else
    <a href="{{ url(@$link_ext_btn) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}">
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </a>
@endif