<div class="quote_product_structure quote_supp_item{{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @include('quotes.products.papers.supply_print')
    <div class="paper_ajax_after_print" style="display: {{ @$supply_obj->except_handle == 1 ? 'none' : '' }}">
        @if (@$supp_index == 0 || !empty($supply_obj))
            @include('quotes.products.papers.after_print', ['data_paper' => @$supply_obj])    
        @endif
    </div>
</div>

