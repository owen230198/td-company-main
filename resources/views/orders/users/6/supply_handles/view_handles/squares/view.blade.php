@php
    $index = @$index ?? 0;
    $data_length = @$supply_size['width'] < @$supply_size['length'] ? @$supply_size['width'] : @$supply_size['length'];
    $base_supp_qty = calValuePercentPlus($supply_obj->supp_qty, $supply_obj->supp_qty, getDataConfig('QuoteConfig', 'COMPEN_PERCENT'), 0, true);
    $base_need = $base_supp_qty*($data_length/10);
@endphp
<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        Xuất vật tư {{ @$note }} theo yêu cầu
    </h3>
    <div class="__supply_handle_list" data-table = "square_warehouses" data-need ="{{ $base_need }}">
        @include('orders.users.6.supply_handles.view_handles.squares.item')   
    </div>
    <button type="button" 
    class="main_button color_white bg_green border_green radius_5 font_bold smooth __supply_handle_button_add" 
    data-type = "squares"
    data-key = {{ $key_supp }}
    data-note = {{ $note }}
    data-supp = {{ $supp_price }}>
       <i class="fa fa-plus mr-2 fs-14"></i>Thêm
    </button>
</div>