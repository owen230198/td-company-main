@extends('print_data.index')
@section('content')
    @include('print_data.header', ['title' => 'Lệnh sản xuất - Giấy in'])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2"><span class="w_60 d-block">Tên hàng</span> <span class="font_bold ml-1">: {{ $data_item->name }}</span></p>   
    </div>
    <div class="mt-3">
        @php
            $nilon = !empty($data_item->nilon) ? json_decode($data_item->nilon, true) : [];
        @endphp
        @if (!empty($nilon['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Cán</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::NILON, $nilon) }}</span>
            </p>     
        @endif

        @php
            $metalai = !empty($data_item->metalai) ? json_decode($data_item->metalai, true) : [];
        @endphp
        @if (!empty($metalai['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Cán metalai</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::METALAI, $metalai) }}</span>
            </p>     
        @endif
        
        @php
            $compress = !empty($data_item->compress) ? json_decode($data_item->compress, true) : [];
        @endphp
        @if (!empty($compress['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Ép nhũ</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::COMPRESS, $compress) }}</span>
            </p>     
        @endif

        @php
            $uv = !empty($data_item->uv) ? json_decode($data_item->uv, true) : [];
        @endphp
        @if (!empty($uv['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">In lưới UV</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::UV, $uv) }}</span>
            </p>     
        @endif
        
        @php
            $elevate = !empty($data_item->elevate) ? json_decode($data_item->elevate, true) : [];
        @endphp
        @if (!empty($elevate['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Bế</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::ELEVATE, $elevate) }}</span>
            </p>     
        @endif

        @php
            $float = !empty($data_item->float) ? json_decode($data_item->float, true) : [];
        @endphp
        @if (!empty($float['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Thúc nổi</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::FLOAT, $float) }}</span>
            </p>     
        @endif

        @php
            $peel = !empty($data_item->peel) ? json_decode($data_item->peel, true) : [];
        @endphp
        @if (!empty($peel['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Bóc lề</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::PEEL, $peel) }}</span>
            </p>     
        @endif

        @php
            $cut = !empty($data_item->cut) ? json_decode($data_item->cut, true) : [];
        @endphp
        @if (!empty($cut['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Xén</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::CUT, $cut) }}</span>
            </p>     
        @endif

        @php
            $fold = !empty($data_item->fold) ? json_decode($data_item->fold, true) : [];
        @endphp
        @if (!empty($fold['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Gấp vạch</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::FOLD, $fold) }}</span>
            </p>     
        @endif

        @php
            $box_paste = !empty($data_item->box_paste) ? json_decode($data_item->box_paste, true) : [];
        @endphp
        @if (!empty($box_paste['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Dán hộp</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::BOX_PASTE, $box_paste) }}</span>
            </p>     
        @endif

        @php
            $bag_paste = !empty($data_item->bag_paste) ? json_decode($data_item->bag_paste, true) : [];
        @endphp
        
        @if (!empty($bag_paste['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_100 d-block">Dán túi</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::BAG_PASTE, $bag_paste) }}</span>
            </p>     
        @endif
    </div>

    <div class="print_print_data_content mt-4 pt-4 border_top_dashed">
        @include('print_data.header', ['title' => 'lệnh In - vật tư giấy'])
        <div class="handle_content_print mt-4">
            <p class="d-flex align-items-center mb-2"><span class="w_60 d-block">Tên hàng</span> <span class="font_bold ml-1">: {{ $data_item->name }}</span></p>   
        </div>
        <div class="mt-3">
            @php
                $print = !empty($data_item->nilon) ? json_decode($data_item->print, true) : [];
                $size = !empty($data_item->size) ? json_decode($data_item->size, true) : [];
            @endphp
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Kiểu in</span> 
                <span class="ml-1">: {{ @\TDConst::PRINT_TECH[$print['type']] }}</span>
            </p>  
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Số màu in</span> 
                <span class="ml-1">: {{ @\TDConst::PRINT_COLOR[$print['color']] }}</span>
            </p> 
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Công nghệ in</span> 
                <span class="ml-1">: {{ @\TDConst::PRINT_COLOR[$print['machine']] }}</span>
            </p>  
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Ghi chú</span> 
                <span class="ml-1">: {{ @$print['note'] }}</span>
            </p> 
            @if (!empty($size['materal']))
                <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                    <span class="w_120 d-block">Chất liệu giấy</span> 
                    <span class="ml-1">: {{ getFieldDataById('name', 'materals', $size['materal']) }}</span>
                </p> 
            @endif 
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Định lượng</span> 
                <span class="ml-1">: {{ $size['qttv'] }}</span>
            </p>
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Khổ giấy</span> 
                <span class="ml-1">: {{ $size['length'] .' x ' . $size['width'] }}</span>
            </p> 
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Số lượng cần lấy</span> 
                <span class="ml-1">: {{ $data_item->supp_qty }}</span>
            </p> 
        </div>
    </div>
@endsection