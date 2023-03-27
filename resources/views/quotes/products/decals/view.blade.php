<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>{{ $pindex == 0 ? 'Phần decal nhung' : 'Decal nhung thêm '.$pindex }}</span>
    </h3>
    @php
        $decal_compen_percent = 0;
        $decal_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    @endphp
    
    <div class="quantity_paper_module" data-percent = {{ $decal_compen_percent }} data-num = {{ $decal_compen_num }}>
        @php
            $pro_decal_qty = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_decal_qty)

        <div class="d-flex align-items-center mb-2 fs-13">
            <label class="mb-0 min_180 text-capitalize text-right mr-3">
                <span class="fs-15 mr-1">*</span>Chọn kích thước
            </label>
            <div class="d-flex justify-content-between align-items-center">
                <select name="product[{{ $j }}][decal][{{ $pindex }}][size][from]" class="form-control medium_input">
                    <option class="rubber">Cao su non</option>
                    <option class="styro">Mút phẳng</option>
                    <option class="carton">Carton</option>
                </select>
                <span class="mx-3">=</span>
                <input type="number" name = 'product[{{ $j }}][decal][{{ $pindex }}][size][length]' placeholder="Chiều dài (cm)" 
                class="form-control medium_input" step="any"> 
                <span class="mx-2">X</span>
                <input type="number" name = 'product[{{ $j }}][decal][{{ $pindex }}][size][width]' placeholder="Chiều rộng (cm)" 
                class="form-control medium_input" step="any"> 
                <span class="mx-2">+</span>
                <input type="number" name = 'product[{{ $j }}][decal][{{ $pindex }}][size][margin]' placeholder="Thừa lề (cm)" 
                class="form-control medium_input" step="any">
                <span class="ml-2 color_red font-italic">Khớp chiều 150cm</span> 
            </div>
        </div>

        @php
            $pro_decal_nqty = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][nqty]',
                'note' => 'Tổng số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_decal_nqty)
        
        @php
            $pro_decal_qty = [
                'name' => 'product['.$j.'][decal]['.$pindex.'][decal_qty]',
                'note' => 'Số lượng tờ in',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_decal_qty)
            <span class="ml-1 color_gray">+ {{ $decal_compen_num }} BH</span>
        </div> 
    </div>

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
    {{-- @php
        $pro_decal_mill_nqty = [
            'name' => 'product['.$j.'][decal]['.$pindex.'][nqty_mill]',
            'note' => 'Xén số bát',
            'value' => 0
        ] 
    @endphp
    @include('view_update.view', $pro_decal_mill_nqty) --}}
</div>