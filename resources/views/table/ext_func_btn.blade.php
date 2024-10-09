@php
    $link_ext_btn = @$button['link'];
    if (!empty($link_ext_btn)) {
        if (str_contains($link_ext_btn, '<id>') || str_contains($link_ext_btn, '<table>')) {
            if (str_contains($link_ext_btn, '<id>')) {
            $link_ext_btn = str_replace('<id>', $data->id, $link_ext_btn);
            }
            if (str_contains($link_ext_btn, '<table>')) {
                $link_ext_btn = str_replace('<table>', $tableItem['name'], $link_ext_btn);
            }
        }else{
            $link_ext_btn = $link_ext_btn.''.$data->id;    
        }
    }
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
        @endif
        >
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </button>
@else
    <a href="{{ url(@$link_ext_btn) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}" {{ !empty($button['blank']) ? 'target=blank' : '' }}>
        <i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
    </a>
@endif