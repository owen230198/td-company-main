@if ((!empty($supply_obj->id) && $supp_index > 0) || $supp_index > 0)
    <span class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth" data-id = "{{ @$supply_obj->id }}" data-table="{{ @$supp_table }}">
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>   
@endif
@if (!empty($supply_obj->id))
    <input type="hidden" name="product[{{ $pro_index }}][{{ $key_supp }}][{{ $supp_index }}][id]" value="{{ $supply_obj->id }}">
@endif