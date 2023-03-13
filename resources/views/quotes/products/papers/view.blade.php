<div class="section_quote_print_paper">
    <div class="list_paper_config">
        <div class="quote_paper_item item_main">
            @include('quotes.products.papers.ajax_view')
        </div>    
    </div>
    <div class="group_btn_action_form text-center mt-4">
        <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
          <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
        </button>
        <button type="button" data-product="{{ $j }}" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_print_paper_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm tờ in
        </button>
        <a href="" class="main_button color_white bg_green radius_5 font_bold smooth">
            <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Chọn khách hàng khác
        </a>
        <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
          <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
        </a>
    </div> 
</div>