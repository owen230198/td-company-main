@php
    $fld_pro_qty = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][qty]',
        'note' => 'Số lượng sản phẩm',
        'value' => @$supply_obj->product_qty ?? @$pro_qty,
        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
    ];
    $fld_pro_nqty = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][nqty]',
        'note' => 'Số bát',
        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
        'value' => @$supply_obj->nqty
    ];
    $fld_pro_qty_supp = [
        'name' => 'product['.$pro_index.']['.$key_supp.']['.$supp_index.'][supp_qty]',
        'note' => 'Tổng SL vật tư',
        'value' => @$supply_obj->supp_qty,
        'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input', 'readonly' => 1]
    ]; 
@endphp
<div class="quantity_paper_module quantity_supply_module" data-percent = {{ $compen_percent }} data-num = "0">
    @include('view_update.view', $fld_pro_qty)

    @include('view_update.view', $fld_pro_nqty)
    
    <div class="d-flex">
        @include('view_update.view', $fld_pro_qty_supp)
        <span class="ml-1 color_gray mt-1"> x {{ $compen_percent }} % BH</span>
    </div> 
</div>