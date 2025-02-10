@php
    $arr_value = !empty($value) ? $value: [];
@endphp
<div class="json_supply_buy p-2 radius_5 box_shadow_3">
    <div class="list_supply_buy">
        @if (count($arr_value) > 0)
            @foreach ($arr_value as $key => $supp_val)
                @include('supply_buyings.supply_item', ['index' => $key, 'value' => $supp_val, 'supp_type' => @$dataItem['type']])
            @endforeach
            @else
                @include('supply_buyings.supply_item', ['index' => 0, 'supp_type' => @$dataItem['type']])   
        @endif
    </div>
   
    @if ((\GroupUser::isPlanHandle() || \GroupUser::isAdmin()))
        <div class="text-center">
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_buy_button">
                <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
            </button>
        </div>
    @endif
</div>