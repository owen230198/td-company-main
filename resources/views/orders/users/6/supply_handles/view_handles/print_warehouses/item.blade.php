@php
    $chose_supp = [
        'name' => 'c_supply['.$key_supp.']['.$index.'][size_type]',
        'type' => 'linking',
        'note' => 'Tìm và chọn khổ giấy in',
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'print_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'qtv' => $qtv,
                            'except_value' => '{"field" :"id","value":"'.@$except_value.'"}',
                            'status' => 'imported']
            ]
        ]
    ];
    $need_qty = [
        'name' => '',
        'type' => 'text',
        'note' => 'Tổng SL vật tư cần xuất : ',
        'attr' => ['type_input' => 'number', 'disable_field' => 1,'inject_class' => '__qty_supp_plan __supp_plan_qty_change'],
        'value' => @$supply_obj->supp_qty ?? 0
    ];
    $nqty_supp = [
        'name' => '',
        'type' => 'text',
        'note' => 'Chia số bát/khổ tồn : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__nqty_supp_plan __supp_plan_qty_change'],
        'value' => 0
    ];
    $total_qty_supp = [
        'name' => '',
        'type' => 'text',
        'note' => 'Yêu cầu xuất kho : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__total_qty_supp_plan', 'readonly' => 1],
        'value' => 0
    ];
    $qty_supp_available = [
        'name' => 'c_supply['.$key_supp.']['.$index .'][qty]',
        'type' => 'text',
        'note' => 'Có thể xuất : ',
        'attr' => ['type_input' => 'number', 'inject_class' => '__avaliable_qty_supp_plan plan_input_supp_qty', 'readonly' => 1],
        'value' => 0
    ]
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