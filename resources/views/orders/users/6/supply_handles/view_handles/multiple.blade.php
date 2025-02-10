@php
    $index = @$index ?? 0;
    $param = '&type='.$type;
    foreach ($arr_items as $key => $value) {
        $param .= '&'.$key.'='.$value;
    }
    $link_buying = 'insert/supply_buyings?nosidebar=1&has_data=1&type='.$arr_items['key_supp'].'&name=1';
    if (!empty($sug_buying)) {
        foreach ($sug_buying as $key_b => $value_b) {
            $link_buying .= '&'.$key_b.'='.$value_b;
        }
    }
@endphp
<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        {{ @$arr_items['title_handle'] ?? 
            'Xuất vật tư '. @$arr_items['note'].' | '.getFieldDataById('name', 'supply_types', $arr_items['supp_price']).' | '.getFieldDataById('name', 'supply_prices', @$arr_items['qtv']) }}
    </h3>
    <div class="__supply_handle_list" data-need ="{{ @$arr_items['base_need'] ?? 0 }}" data-type="{{ $type }}">
        @include('orders.users.6.supply_handles.view_handles.'.$type.'.item', $arr_items)
    </div>
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth __supply_handle_button_add" data-param = '{{ $param }}'>
            <i class="fa fa-plus mr-2 fs-14"></i>Thêm
        </button> 
        @if (\GroupUser::isPlanHandle())     
            <button type="button" data-src = "{{ url($link_buying) }}" 
            class="main_button color_white bg_green border_green radius_5 font_bold smooth ml-1 load_view_popup"
            data-toggle="modal" data-target="#actionModal">
                <i class="fa fa-lightbulb-o mr-2 fs-14" aria-hidden="true"></i>Đề xuất mua
            </button>   
        @endif
    </div> 
</div>