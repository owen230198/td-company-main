@php
    $base_qty_field_name = 'product['.$pro_index.']['.$key_supp.']['.$supp_index.']';
    $arr_disable_field = @$arr_disable ?? [];
    $module_fld_supp_qty = [
        [
            'name' => $base_qty_field_name.'[qty]',
            'note' => 'Số lượng sản phẩm',
            'value' => @$supply_obj->product_qty ?? @$pro_qty,
            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input supp_qty_modul_input',
            'disable_field' => !empty($disable_all) || in_array('qty', $arr_disable_field) ? 1 : 0]
        ],
        [
            'name' => $base_qty_field_name.'[nqty]',
            'note' => 'Số bát',
            'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input supp_qty_modul_input',
            'disable_field' => !empty($disable_all) || in_array('nqty', $arr_disable_field) ? 1 : 0],
            'value' => @$supply_obj->nqty
        ],
        [
            'name' => $base_qty_field_name.'[base_supp_qty]',
            'note' => 'Số lượng vật tư',
            'value' => @$supply_obj->base_supp_qty,
            'attr' => ['type_input' => 'number', 'inject_class' => 'supp_qty_input', 'readonly' => 1,
            'disable_field' => !empty($disable_all) || in_array('supp_qty', $arr_disable_field) ? 1 : 0]
        ],
        [
            'name' => $base_qty_field_name.'[compent_percent]',
            'note' => 'Bù hao',
            'attr' => ['type_input' => 'number', 'readonly' => 1, 'inject_class' => 'compent_percent_input'],
            'value' => @$supply_obj->compent_percent ?? 0
        ],
        [
            'name' => $base_qty_field_name.'[compent_plus]',
            'note' => 'Bù hao cộng thêm',
            'attr' => ['type_input' => 'number', 'inject_class' => 'pro_compent_plus_input supp_qty_modul_input',
            'disable_field' => !empty($disable_all) || in_array('nqty', $arr_disable_field) ? 1 : 0],
            'value' => @$supply_obj->compent_plus ?? 0
        ],
        [
            'name' => $base_qty_field_name.'[supp_qty]',
            'note' => 'Tổng SL vật tư',
            'value' => @$supply_obj->supp_qty,
            'attr' => ['type_input' => 'number', 'inject_class' => 'total_supp_qty_input', 'readonly' => 1,
            'disable_field' => !empty($disable_all) || in_array('supp_qty', $arr_disable_field) ? 1 : 0]
        ]
    ];
@endphp
<div class="quantity_supp_module quantity_supply_module" data-percent = {{ @$supply_obj->compen_percent ?? $compen_percent }}>
    @foreach ($module_fld_supp_qty as $qty_field)
        @include('view_update.view', $qty_field)  
    @endforeach  
</div>