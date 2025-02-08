@php
    $where_chose = [
                        'type' => $key_supp,
                        'target' => $supp_price,
                        'except_value' => '{"field" :"id","value":"'.@$except_value.'"}',
                        'status' => 'imported'
                    ];
    if (!empty($qtv)) {
        $where_chose['qtv'] = $qtv;
    }
    $chose_supp = [
        'name' => 'c_supply[square]['.$key_supp.']['.$index.'][size_type]',
        'type' => 'linking',
        'note' => 'Chọn khổ '.$note,
        'attr' => ['inject_class' => '__select_in_warehouse length_input'],
        'value' => '',
        'other_data' => [
            'config' => ['search' => 1, 'except_linking' => 1], 
            'data' => [
                'table' => 'supply_warehouses', 
                'where' => $where_chose
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
        <input type="hidden" name="c_supply[square][{{ $key_supp }}][{{ $index }}][qty]" value="">
        <input type="hidden" name="c_supply[square][{{ $key_supp }}][{{ $index }}][lack]" value="">
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại trong kho : </label>
            <span class="font_bold __inhouse"></span>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Xuất ra cho lệnh này : </label>
            <span class="font_bold __takeout"> </span>
        </div>
        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Còn lại : </label>
            <span class="font_bold __rest"></span>
        </div>
        <div class="align-items-center mb-2 fs-13" style="display: flex">
            <label class="mb-0 min_210 text-capitalize text-right mr-3">Vật tư thiếu : </label>
            <span class="color_red font_bold __lack"></span>
        </div>
    </div>
</div>