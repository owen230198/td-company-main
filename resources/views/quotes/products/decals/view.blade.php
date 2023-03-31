<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>{{ $pindex == 0 ? 'Phần decal nhung' : 'Decal nhung thêm '.$pindex }}</span>
    </h3>
    @php
        $pro_decal_qty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][qty]',
            'note' => 'Số lượng SP',
            'attr' => ['type_input' => 'number', 'required' => 1]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_qty)

    @php
        $pro_decal_nqty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][nqty]',
            'note' => 'Số bát',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_nqty)
    
    @php
        $pro_decal_qty_supp = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][decal_qty]',
            'note' => 'Tổng SL vật tư',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_qty_supp) 
    
    @php
        $pro_decal_length_supp = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][size][length]',
            'note' => 'Kích thước chiều dài',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_length_supp) 

    @php
        $pro_decal_width_supp = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][size][width]',
            'note' => 'Kích thước chiều rộng',
            'type' => 'select',
            'other_data' => ['data' => ['options' => \App\Constants\TDConstant::SELECT_SUPP_LINK]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_width_supp) 

    @php
        $pro_decal_supply = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::DECAL_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_decal_supply)
</div>