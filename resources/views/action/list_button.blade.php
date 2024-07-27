<div class="group_btn_action_form text-center" style="{{ !empty($nosidebar) ? 'width:100%' : '' }}">
    <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-3">
        <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
    </button>
    @php
        $ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
    @endphp
    @if (!empty($ext_action) && !empty($dataItem))
        @foreach ($ext_action as $button)
            @if (!empty($button['condition']))
                @if (getBoolByCondArr($button['condition'], $dataItem->toArray()))
                    @include('action.ext_func_btn')	
                @endif
            @else
                @include('action.ext_func_btn')		
            @endif
        @endforeach
    @endif
    <a href="{{ getBackUrl() }}"
        class="main_button color_white bg_green radius_5 font_bold smooth mr-3">
        <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
    </a>
    <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
        <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
    </a>
</div>