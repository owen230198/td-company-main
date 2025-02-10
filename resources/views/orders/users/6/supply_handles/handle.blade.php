<div class="supply_process_handle">
    <div class="plan_handle_supply_module">
        @include('orders.users.6.supply_handles.view_handles.multiple', 
            [
                'arr_items' => [
                    'key_supp' => $key_supp, 
                    'note' => getSupplyNameByKey($key_supp), 
                    'supp_price' => $supply_size['materal'],
                    'qtv' => $supply_size['qtv'],
                    'base_need' =>  $supply_obj->product_qty,
                    'product_qty' => $supply_obj->product_qty,
                    'over_supply' => true
                ],
                'sug_buying' => [
                    'target' => $supply_size['materal'],
                    'qtv' => $supply_size['qtv'],
                    'width' => $supply_size['width'],
                    'length' => $supply_size['length'],
                    'qty' => $supply_obj->supp_qty,
                ],
                'type' => \TDConst::PLATE
            ])
    </div>
</div>