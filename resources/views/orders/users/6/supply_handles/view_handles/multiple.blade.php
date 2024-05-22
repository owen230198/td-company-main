@php
    $index = @$index ?? 0;
    $param = '&type='.$type;
    foreach ($arr_items as $key => $value) {
        $param .= '&'.$key.'='.$value;
    }
@endphp
<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        {{ @$arr_items['title_handle'] ?? 'Xuất vật tư '. @$arr_items['note'].' theo yêu cầu' }}
    </h3>
    <div class="__supply_handle_list" data-table = {{ $type }} data-need ="{{ @$arr_items['base_need'] ?? 0 }}">
        @include('orders.users.6.supply_handles.view_handles.'.$type.'.item', $arr_items)
    </div>
    <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth __supply_handle_button_add" data-param = '{{ $param }}'>
        <i class="fa fa-plus mr-2 fs-14"></i>Thêm
     </button>  
</div>