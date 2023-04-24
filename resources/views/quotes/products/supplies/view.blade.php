<div class="module_quote_supp_config">
    <div class="list_supp_item">
        @if (!empty($data_supply))
            @foreach ($data_supply as $supp_index => $supply)
                @php
                    $supply->size = !empty($supply->size) ? json_decode($supply->size, true) : [];
                @endphp
                @include('quotes.products.'.$supp_view.'.ajax_view', ['supp_index' => $supp_index, 'supply_obj' => $supply, 'supply_size' => $supply->size])  
            @endforeach
        @else
            @include('quotes.products.'.$supp_view.'.ajax_view', ['supp_index' => 0])  
        @endif
    </div>
    <div class="text-center my-3">
        <button type="button" data-product="{{ $pro_index }}" data-key={{ $supp_view }}
        class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div> 
</div>