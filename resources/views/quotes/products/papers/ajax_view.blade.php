<div class="quote_product_structure quote_supp_item{{ $supp_index > 0 ? ' mt-4 border_green p-3 radius_5' : '' }}" data-index={{ @$supp_index ?? 0 }}>
    @include('quotes.products.papers.supply_print', ['rework' => @$rework])
</div>

