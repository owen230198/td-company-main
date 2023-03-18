<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>{{ $pindex == 0 ? 'Phần vật tư mút phẳng' : 'Vật tư mút phẳng thêm '.$pindex }}</span>
    </h3>
    @php
        $styro_compen_percent = 0;
        $styro_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    @endphp
    
    <div class="quantity_paper_module" data-percent = {{ $styro_compen_percent }} data-num = {{ $styro_compen_num }}>
        @php
            $pro_styro_qty = [
                'name' => 'product['.$j.'][styro]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_styro_qty)

        @php
            $pro_styro_nqty = [
                'name' => 'product['.$j.'][styro]['.$pindex.'][nqty]',
                'note' => 'Số bát/tờ in',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_styro_nqty)
        
        @php
            $pro_styro_qty = [
                'name' => 'product['.$j.'][styro]['.$pindex.'][styro_qty]',
                'note' => 'Số lượng tờ in',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_styro_qty)
            <span class="ml-1 color_gray">+ {{ $styro_compen_num }} BH</span>
        </div> 
    </div>
    <div class="d-flex align-items-center mb-2 fs-13">
        <label class="mb-0 min_180 text-capitalize text-right mr-3">
            <span class="fs-15 mr-1">*</span>Kích thước
        </label>
        <div class="d-flex justify-content-between align-items-center">
            <input type="number" name = 'product[{{ $j }}][styro][{{ $pindex }}][size][length]' placeholder="Chiều dài (cm)" 
            class="form-control medium_input" step="any"> 
            <span class="mx-3">X</span>
            <input type="number" name = 'product[{{ $j }}][styro][{{ $pindex }}][size][width]' placeholder="Chiều rộng (cm)" 
            class="form-control medium_input" step="any"> 
        </div>
    </div>

    @php
        $pro_styro_supply = [
            'name' => 'product['.$j.'][styro]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::STYRO_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_styro_supply)
    @php
        $pro_styro_supply = [
            'name' => 'product['.$j.'][styro]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    @endphp
    @include('view_update.view', $pro_styro_supply)

    @php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'styro'])
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'styro'])
</div>