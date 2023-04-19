<div class="module_quote_supp_config">
    <div class="list_supp_item">
        @include('quotes.products.'.$supp_view.'.ajax_view')  
    </div>
    <div class="text-center my-3">
        <button type="button" data-product="{{ $j }}" 
        class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div> 
</div>