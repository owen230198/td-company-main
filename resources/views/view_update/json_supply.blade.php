@php
    $arr_value = !empty($value) ? json_decode($value, true) : [];
@endphp
<div class="json_supply_buy p-2 radius_5 box_shadow_3 form-control length_input">
    <div class="list_supply_buy">
        @if (count($arr_value) > 0)
            @foreach ($arr_value as $key => $supp_val)
                @include('supply_buyings.supply_item', ['index' => $key, 'value' => $supp_val])
            @endforeach
            @else
                @include('supply_buyings.supply_item', ['index' => 0])   
        @endif
    </div>
    @if (\GroupUser::isPlanHandle() && empty($dataItem->status))
    <div class="text-center">
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_supp_buy_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm vật tư
        </button>
    </div>
    @endif
    @if (\GroupUser::isAdmin() || \GroupUser::isDoBuying() || \GroupUser::isWarehouse())
        @php
            $readonly_price = \App\Models\SupplyBuying::checkReadOnlyInputPrice(@$dataItem->status);
            $do_buy_fields = [
                [
                    'name' => 'ship_price',
                    'type' => 'text',
                    'note' => 'Chi phí vận chuyển',
                    'attr' => ['type_input' => 'price', 'readonly' => $readonly_price , 'inject_class' => '__buying_ship_price __buying_change_total_input'],
                    'value' => @$dataItem['ship_price'] ?? 0
                ],
                [
                    'name' => 'other_price',
                    'type' => 'text',
                    'note' => 'Chi phí khác',
                    'attr' => ['type_input' => 'price', 'readonly' => $readonly_price , 'inject_class' => '__buying_other_price __buying_change_total_input'],
                    'value' => @$dataItem['other_price'] ?? 0
                ],
                [
                    'name' => 'total',
                    'type' => 'text',
                    'note' => 'Tổng tiền mua hàng',
                    'attr' => ['type_input' => 'price', 'readonly' => 1, 'inject_class' => '__buying_total_amount_input'],
                    'value' => @$dataItem['total'] ?? 0
                ],
                [
                    'name' => 'bill',
                    'note' => 'Hóa đơn mua hàng',
                    'type' => 'filev2',
                    'other_data' => ['role_update' => [\GroupUser::WAREHOUSE], 'field_name' => 'bill'],
                    'value' => @$dataItem['bill']
                ]
            ];
            if (\GroupUser::isDoBuying()) {
                unset($do_buy_fields[3]);
            } 
        @endphp
        @foreach ($do_buy_fields as $do_buy_field)
            @php
                $do_buy_field['min_label'] = 175;
            @endphp
            @include('view_update.view', $do_buy_field) 
        @endforeach
    @endif  
</div>