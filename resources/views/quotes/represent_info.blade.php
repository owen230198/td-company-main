<input type="hidden" name="represent" value="{{ @$represent->id }}">
@include('quotes.base_field', ['fields' => $represent_fields, 'data_field' => $represent])
<div class="d-flex align-items-end form-group">
    <label class="mb-0 min_210 fs-13 text-capitalize justify-content-end mr-3 d-flex align-items-center"></label>
    <div class="group_btn_action_form_chose_customer d-flex align-items-center justify-content-end mb-2 form-control border-none">
        <button type="submit" disabled class="main_button bg_main color_white smooth bg_green border_green radius_5 font_bold smooth mr-3">
        <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <a href="{{ url('') }}" class="main_button bg_red color_white smooth radius_5 font_bold smooth red_btn">
        <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
    </div>
</div>
