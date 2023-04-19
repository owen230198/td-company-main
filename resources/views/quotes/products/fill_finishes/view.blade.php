@php
    $pro_fill_finish_qty = [
        'name' => 'product['.$pro_index.'][fill_finish][qty]',
        'note' => 'Số lượng',
        'value' => @$pro_qty,
        'attr' => ['type_input' => 'number', 'required' => 1,]
    ];
    $pro_fill_ext = [
        'name' => 'product['.$pro_index.'][fill_finish][fill][ext_price]',
        'note' => 'Phát sinh chi tiết bồi khó',
        'value' => 0,
        'attr' => ['type_input' => 'number']
    ];

    $pro_finish_ext = [
        'name' => 'product['.$pro_index.'][fill_finish][finish][ext_price]',
        'note' => 'Phát sinh chi tiết hoàn thiện',
        'value' => 0,
        'attr' => ['type_input' => 'number']
    ];

    $data_select_magnet = [
        'other_data' => [
            'data' => ['table' => 'supply_prices', 'where' => ['type' => \TDConst::MAGNET]]
        ],
        'name' => 'product['.$pro_index.'][fill_finish][magnet][type]',
        'type' => 'linking',
        'note' => 'Vật tư nam châm'
    ];

    $data_magnet_qty = [
        'name' => 'product['.$pro_index.'][fill_finish][magnet][qty]',
        'note' => 'Số viên nam châm/hộp',
        'attr' => ['type_input' => 'number']
    ]
@endphp

@include('view_update.view', $pro_fill_finish_qty)

<div class="module_fill_quote pb-2 mb-2 border_bot_eb section_quote_fill_finish">
    <div class="d-flex align-items-end list_item_fill_finish">
        <div class="ajax_fill_quote ajax_ff_quote">
            @include('quotes.products.fill_finishes.ajax_fill')
        </div>
        <button type="button" data-product="{{ $pro_index }}" data-view="ajax_fill"
        class="main_button color_white bg_green border_green radius_5 font_bold sooth quote_add_fill_item ml-5 mb-2 add_fill_finish_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm chi tiết
        </button>
    </div>
    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_fill_ext)
        <span class="fs-12 color_red font-italic ml-2">ĐG/1 sản phẩm</span>
    </div>
</div>

<div class="module_finish_quote pb-2 mb-2 border_bot_eb section_quote_fill_finish">
    <div class="d-flex align-items-end list_item_fill_finish">
        <div class="ajax_fill_quote ajax_ff_quote">
            @include('quotes.products.fill_finishes.ajax_finish')
        </div>
        <button type="button" data-product="{{ $pro_index }}" data-view="ajax_finish" 
        class="main_button color_white bg_green border_green radius_5 font_bold sooth quote_add_finish_item ml-5 mb-2 add_fill_finish_quote_button">
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm chi tiết
        </button>
    </div>
    <div class="d-flex align-items-center">
        @include('view_update.view', $pro_finish_ext)
        <span class="fs-12 color_red font-italic ml-2">ĐG/1 sản phẩm</span>
    </div>
</div>

@include('view_update.view', $data_select_magnet)

@include('view_update.view', $data_magnet_qty)