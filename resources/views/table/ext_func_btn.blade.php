@php
    $link_ext_btn = getDataLinkButton(@$button['link'], $data);
@endphp
@if (@$button['type'] == 2)
    <button type="button" class="table-btn mr-2 mb-2 {{ @$button['class'] }}" title="{{ @$button['note'] }}" data-table="{{ $tableItem['name'] }}" data-id="{{ $data->id }}"
        @if (!empty($button['datas']))
            @foreach ($button['datas'] as $dt)
                @if (!empty($data->{$dt}))
                    {!! "data-".$dt."='".$data->$dt."'"  !!}
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
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </button>
@else
    <a href="{{ url(@$link_ext_btn) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}" {{ !empty($button['blank']) ? 'target=blank' : '' }}>
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </a>
@endif