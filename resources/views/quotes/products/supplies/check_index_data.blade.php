@if ((!empty($supply_obj->id)) || $supp_index > 0)
    @php
        $supp_table = @!empty($supply_obj->getTable()) ? 'products' : @$supp_table;
    @endphp
    <span class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth" data-id = "{{ @$supply_obj->id }}" 
        data-table="{{ $supp_table }}">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>
    
    @if (!empty($supply_obj->id))
        <button type="button" 
            class="btn btn-primary main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth ml-3 load_view_popup" 
            data-toggle="modal" data-target="#actionModal"
            data-src={{ url('history-table/'.$supp_table.'?target='.$supply_obj->id) }}>
            <i class="fa fa-history mr-2 fs-15" aria-hidden="true"></i>Lịch sử chỉnh sửa
        </button>   
    @endif
@endif
@if (!empty($supply_obj->id))
    <input type="hidden" name="product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][id]" value="{{ $supply_obj->id }}">
@endif