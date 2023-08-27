<div class="__module_multiple_handle_supply">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        Xuất vật tư {{ @$note }} theo yêu cầu
    </h3>
    <div class="__supply_handle_list" data-table = "square_warehouses" data-need ="{{ @$base_need ?? 0 }}">
        @yield('items')
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