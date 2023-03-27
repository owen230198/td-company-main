<div class="mb-2 paper_product_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>{{ $pindex == 0 ? 'Phần vật tư cao su non' : 'Vật tư cao su non thêm '.$pindex }}</span>
    </h3>
    @php
        $rubber_compen_percent = 0;
        $rubber_compen_num = \App\Constants\TDConstant::CARTON_COMPEN_NUM;
    @endphp
    
    <div class="quantity_paper_module" data-percent = {{ $rubber_compen_percent }} data-num = {{ $rubber_compen_num }}>
        @php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][qty]',
                'note' => 'Số lượng',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_qty_input paper_qty_modul_input']
            ] 
        @endphp
        @include('view_update.view', $pro_rubber_qty)

        @include('quotes.products.supply_size', ['supp_key' => 'rubber', 'with_size1' => '120', 'with_size2' => '244'])

        @php
            $pro_rubber_nqty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][nqty]',
                'note' => 'Tổng số bát',
                'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'pro_nqty_input paper_qty_modul_input'],
                'value' => @$pro_size['nqty'] ?? 1
            ] 
        @endphp
        @include('view_update.view', $pro_rubber_nqty)
        
        @php
            $pro_rubber_qty = [
                'name' => 'product['.$j.'][rubber]['.$pindex.'][rubber_qty]',
                'note' => 'Số lượng tờ in',
                'attr' => ['type_input' => 'number', 'inject_class' => 'paper_qty_input'],
            ] 
        @endphp
        <div class="d-flex align-items-center">
            @include('view_update.view', $pro_rubber_qty)
            <span class="ml-1 color_gray">+ {{ $rubber_compen_num }} BH</span>
        </div> 
    </div>
    @php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn vật tư',
            'attr' => ['required' => 1, 'inject_class' => 'select_supply'],
            'other_data' => ['config' => ['search' => 1], 
            'data' => ['table' => 'supplies', 'where' => ['type' => \App\Constants\TDConstant::RUBB_SUPP]]]
        ] 
    @endphp
    @include('view_update.view', $pro_rubber_supply)
    @php
        $pro_rubber_supply = [
            'name' => 'product['.$j.'][rubber]['.$pindex.'][supplies]',
            'type' => 'linking',
            'note' => 'Chọn định lượng',
            'attr' => ['required' => 1, 'inject_class' => 'ajax_supply_price'],
            'other_data' => ['config' => ['search_box' => 1], 'data' => ['table' => 'supply_prices']]
        ] 
    @endphp
    @include('view_update.view', $pro_rubber_supply)

    @php
        $key_device_elevate = \App\Constants\TDConstant::ELEVATE;
        $key_device_peel = \App\Constants\TDConstant::PEEL;
    @endphp
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_elevate, 'note' => 'Máy bế', 'value' => getDeviceIdByKey($key_device_elevate), 'element' => 'rubber'])
    @include('quotes.products.select_device', 
    ['key_device' => $key_device_peel, 'note' => 'Bóc lề', 'value' => getDeviceIdByKey($key_device_peel), 'element' => 'rubber'])
</div>