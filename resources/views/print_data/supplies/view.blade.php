@extends('print_data.index')
@section('content')
    @include('print_data.header', ['title' => 'Lệnh sản xuất - '. getTextSupply($data_item->type)])
    <div class="handle_content_print mt-4">
        <p class="d-flex align-items-center mb-2">
            <span class="w_60 d-block">Tên hàng</span> 
            <span class="font_bold ml-1">: {{ getFieldDataById('name', 'products', $data_item->product) }}</span>
        </p>   
    </div>
    <div class="mt-3">
        @php
            $cut = !empty($data_item->cut) ? json_decode($data_item->cut, true) : [];
        @endphp
        @if (!empty($cut['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Xén</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::CUT, $cut) }}</span>
            </p>     
        @endif

        @php
            $elevate = !empty($data_item->elevate) ? json_decode($data_item->elevate, true) : [];
        @endphp
        @if (!empty($elevate['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Bế</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::ELEVATE, $elevate) }}</span>
            </p>     
        @endif
        
        @php
            $mill = !empty($data_item->mill) ? json_decode($data_item->mill, true) : [];
        @endphp
        @if (!empty($mill['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Phay</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::CUT, $mill) }}</span>
            </p>     
        @endif

        @php
            $peel = !empty($data_item->peel) ? json_decode($data_item->peel, true) : [];
        @endphp
        @if (!empty($peel['act']))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Bóc lề</span> 
                <span class="ml-1">: {{ getTextdataPaperStage(\TDConst::PEEL, $peel) }}</span>
            </p>     
        @endif

        @if (!empty($data_item->note))
            <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
                <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
                <span class="w_120 d-block">Ghi chú</span> 
                <span class="ml-1">: {{ $data_item->note }}</span>
            </p> 
        @endif 
        @php
            $size = !empty($data_item->size) ? json_decode($data_item->size, true) : [];
            $supp_name = '';
            if (!empty($size['supply_type'])) {
                $supp_name .= getFieldDataById('name', 'supply_types', $size['supply_type']).' - DL : ';
                $supp_name .= getFieldDataById('name', 'supply_prices', $size['supply_price']);
            }else{
                $supp_name .= getFieldDataById('name', 'materals', $size['supply_price']);
            }
        @endphp
        <p class="d-flex align-items-center mb-1 pb-1 border_bot_eb">
            <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
            <span class="w_120 d-block">Loại vật tư</span> 
            <span class="ml-1">: {{ $supp_name }}</span>
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
@endsection