<ul class="nav nav-pills mb-3 quote_pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_185 mr-3"></label>
    @for($i = 0; $i < $qty; $i++)
    <li class="nav-item">
        <a class="nav-link{{ $i == 0 ? ' active' : '' }}" id="quote-pro-{{ $i }}-tab" data-toggle="pill" href="#quote-pro-{{ $i }}" role="tab" aria-controls="quote-pro-{{ $i }}" aria-selected="true">Sản phẩm {{ $i+1 }}</a>
    </li>
    @endfor
</ul>

<div class="tab-content" id="quote-pro-tabContent">
    @for($j = 0; $j < $qty; $j++)
        <div class="tab-pane fade{{ $j == 0 ? ' show active' : '' }} tab_pane_quote_pro" id="quote-pro-{{ $j }}" role="tabpanel" aria-labelledby="quote-pro-{{ $j }}-tab">
            <div class="config_handle_paper_pro">
                <div class="mb-2 base_product_config">
                    @php
                        $pro_name_field = [
                            'name' => 'product['.$j.'][name]',
                            'note' => 'Tên sản phẩm',
                            'attr' => ['required' => 1, 'inject_class' => 'quote_set_product_name']
                        ] 
                    @endphp
                    @include('view_update.view', $pro_name_field)

                    @php
                    $pro_name_field = [
                        'name' => 'product['.$j.'][qty]',
                        'note' => 'SL sản phẩm',
                        'attr' => ['type_input' => 'number', 'required' => 1, 'inject_class' => 'input_pro_qty'],
                    ] 
                @endphp
                @include('view_update.view', $pro_name_field)
                    
                    @php
                        $pro_category_field = [
                            'name' => 'product['.$j.'][category]',
                            'type' => 'linking',
                            'note' => 'Nhóm sản phẩm',
                            'attr' => ['required' => 1 , 'inject_class' => 'select_quote_procategory', 'inject_attr' => 'proindex='.$j],
                            'other_data' => ['data' => ['table' => 'product_categories']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_category_field)

                    <div class="quote_product_design_config">
                        @php
                            $quote_pro_design = [
                                'name' => 'product['.$j.'][design]',
                                'note' => 'thiết kế',
                                'type' => 'linking',
                                'other_data' => ['data' => ['table' => 'design_types', 'select' => ['id', 'name']]]
                            ]
                        @endphp
                        @include('view_update.view', $quote_pro_design)
                    </div>

                    @php
                        $pro_size_field = [
                            'name' => 'product['.$j.'][size]',
                            'note' => 'Kích thước hộp',
                            'attr' => ['placeholder' => 'D x R x C']
                        ]
                    @endphp
                    @include('view_update.view', $pro_size_field)
                </div>
                <div class="ajax_product_view_by_category mt-4">
                   
                </div>
            </div>
        </div>
    @endfor
</div>