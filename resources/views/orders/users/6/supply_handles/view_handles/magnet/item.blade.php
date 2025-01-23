@php
    $where_chose = [
        'type' => $key_supp,
        'except_value' => '{"field" :"id","value":"'.@$except_value.'"}',
        'status' => 'imported'
    ];
    if (!empty($supp_price)) {
        $where_chose['target'] = $supp_price;
    }
    $chose_supp = [
        'name' => 'c_supply['.$key_supp.']['.$index.'][size_type]',
        'type' => 'linking',
        'note' => 'Chọn loại nam châm',
        'attr' => ['inject_class' => '__select_in_warehouse length_input'],
        'value' => '',
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'supply_warehouses', 
                'where' => $where_chose
            ]
        ]
    ];
@endphp
<div class="__handle_supply_item position-relative {{ $index > 0 ? 'mt-3 pt-3 border_top_eb' : '' }}" data-take = "0">
    @if ($index > 0)
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    @endif
    <div class="row">
        <div class="col-6">
            @include('view_update.view', $chose_supp)
            <div class="__handle_supply_detail_ajax color_green" style="display:none">
                <div class="d-flex align-items-center mb-2 fs-13">
                    <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
                    <p class="font_bold __inhouse"></p>
                </div>
                @include('view_update.view', $need_qty)
                @include('view_update.view', $nqty_supp)
                @include('view_update.view', $total_qty_supp)
                @include('view_update.view', $qty_supp_available)
                @include('orders.users.6.supply_handles.view_handles.after_select')
            </div>
        </div>
        <div class="col-6 border_left_eb __over_supply" style="display:none">
            @include('orders.users.6.supply_handles.view_handles.over_supplies.item', ['key_supp' => $key_supp])      
        </div> 
    </div>
</div>