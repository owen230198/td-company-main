@php
    $chose_supp = [
        'name' => 'c_supply[materal]['.$key_supp.']]['.$index.'][supp_price]',
        'type' => 'linking',
        'note' => 'Chọn khổ '.$note,
        'attr' => ['inject_class' => '__select_in_warehouse'],
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'square_warehouses', 
                'where' => ['type' => $key_supp,
                            'supp_price' => $supp_price,
                            'except_value' => '{"field" :"id","value":"'.@$except_value.'"}',
                            'status' => 'imported']
            ]
        ]
    ]
@endphp
<div class="__handle_supply_item position-relative {{ $index > 0 ? 'mt-3 pt-3 border_top_eb' : '' }}" data-take = "0">
    @if ($index > 0)
        <button type="button" class="remove_ext_element_quote d-flex bg_red color_white red_btn smooth __supply_handle_btn_remove">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button> 
    @endif
    @include('view_update.view', $chose_supp)
    <div class="__handle_supply_detail_ajax color_green" style="display:none">
        <input type="hidden" name="c_supply[materal][{{ $key_supp }}]][{{ $index }}][qty]" value="">
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
            <p class="font_bold __square"></p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Xuất ra cho lệnh này : </label>
            <p class="font_bold __takeout"> </p>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại : </label>
            <p class="font_bold __rest"></p>
        </div>
        <div class="align-items-center mb-2 fs-13" style="display: flex">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Vật tư thiếu : </label>
            <p class="color_red font_bold __lack"></p>
        </div>
    </div>
</div>