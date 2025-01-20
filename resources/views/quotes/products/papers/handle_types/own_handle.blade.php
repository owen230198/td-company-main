@php
    $key_supp = \TDConst::PAPER;
    $_compen_percent = getDataConfig('QuoteConfig', 'COMPEN_PERCENT');
    $_plus_direct = (int) getDataConfig('QuoteConfig', 'PLUS_DIRECT');
    $_plus_to_per = (int) getDataConfig('QuoteConfig', 'PLUS_TO_PERCENT');
    $paper_hd_base_name = 'product['.$pro_index.'][paper]['.$supp_index.']';
@endphp
@include('quotes.products.supplies.quantity_config', ['compen_percent' => $_compen_percent, 'plus_direct' => $_plus_direct, 'per_plus' => $_plus_to_per])
@include('quotes.products.select_supply_type', ['key_supp' => $key_supp, 'pro_index' => $pro_index, 'supp_index' => $supp_index, 'key_stage' => 'size'])
<div class="paper_ajax_after_print {{ !empty($rework) ? 'd-none' : '' }}">
    @if ((@$supp_index == 0 || !empty($supply_obj)) && empty($no_exc))
        @include('quotes.products.papers.after_print', ['data_paper' => @$supply_obj])    
    @endif
</div>