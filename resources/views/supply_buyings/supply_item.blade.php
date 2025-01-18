<div class="item_supp_buy mb-3 pb-3 border_bot_main position-relative" data-index = {{ $index }}>
    @if ((\GroupUser::isAdmin() || \GroupUser::isPlanHandle() || \GroupUser::isApplyBuying()) && $index > 0)
        <span class="d-flex color_red smooth remove_parent_element_button" {{ !empty($value['id']) ? ' data-id='.$value['id'].' data-table=buying_items' : '' }}>
            <i class="fa fa-times" aria-hidden="true"></i>
        </span> 
    @endif
    <input type="hidden" class="__select_supp_type_buying" name="{{ 'supply['.$index.'][type]' }}" value="{{ @$supp_type }}">
    <div class="ajax_supply_buying_data">
        @if (!empty($supp_type))
            @php
                $arr_view = getViewSuppluBuyingByType($supp_type, $index, @$value);
            @endphp
            @include('supply_buyings.field_buying', $arr_view)
        @endif     
    </div>  
    @if (!empty($field_injects))
        @foreach ($field_injects as $field_inject)
            @include('view_update.view', $field_inject)    
        @endforeach
    @endif              
</div>