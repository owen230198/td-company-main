<div class="supply_process_handle">
    <div class="plan_handle_supply_module">
        @include('orders.users.6.supply_handles.view_handles.multiple', 
            ['arr_items' => ['key_supp' => $key_supp, 
            'note' => getSupplyNameByKey($key_supp), 
            'supply_type' => $supply_size['supply_type'],
            'supp_price' => $supply_size['supply_price'],
            'base_need' =>  $supply_obj->product_qty,
            'product_qty' => $supply_obj->product_qty,
            'over_supply' => true],
            'type' => 'supply_warehouses'])
    </div>
</div>