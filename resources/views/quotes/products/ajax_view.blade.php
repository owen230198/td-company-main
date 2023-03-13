<ul class="nav nav-pills mb-3 quote_pro_nav_link" id="quote-pro-tab" role="tablist">
    <label class="mb-0 min_150 mr-3"></label>
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
                        $pro_group_field = [
                            'name' => 'product['.$j.'][group]',
                            'type' => 'linking',
                            'note' => 'Nhóm sản phẩm',
                            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'product_categories']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_group_field)
                </div>
                
                <div class="mb-2 detail_product_config">
                    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
                        <span>Sản phẩm gồm các chi tiết sau</span>
                    </h3>
                    @php
                        $pro_design_field = [
                            'name' => 'product['.$j.'][design]',
                            'type' => 'linking',
                            'note' => 'Thiết kế',
                            'other_data' => ['config' => ['search' => 1], 'data' => ['table' => 'qs_type_designs']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_design_field)

                    @php
                        $pro_print_form_field = [
                            'name' => 'product['.$j.'][print_form]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Làm mẫu',
                            'other_data' => ['data' => ['table' => 'qs_print_forms']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_print_form_field)
                    
                    @php
                        $pro_print_tech_field = [
                            'name' => 'product['.$j.'][print_tech]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Công nghệ in',
                            'other_data' => ['data' => ['table' => 'qs_print_techs']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_print_tech_field)  

                    @php
                        $pro_after_print_field = [
                            'name' => 'product['.$j.'][name]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Công đoạn sau in',
                            'other_data' => ['data' => ['table' => 'qs_after_prints']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_after_print_field)

                    @php
                        $pro_box_fill_field = [
                            'name' => 'product['.$j.'][box_fill]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Bồi hộp',
                            'other_data' => ['data' => ['table' => 'qs_box_fills']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_box_fill_field)
                    
                    @php
                        $pro_finish_field = [
                            'name' => 'product['.$j.'][finish]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Hoàn thiện',
                            'other_data' => ['data' => ['table' => 'qs_finishes']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_finish_field)

                    @php
                        $pro_shipping_field = [
                            'name' => 'product['.$j.'][shipping]',
                            'type' => 'multiplechoicelinking',
                            'note' => 'Vận chuyển',
                            'other_data' => ['data' => ['table' => 'qs_shipping_types']]
                        ] 
                    @endphp
                    @include('view_update.view', $pro_shipping_field)
                </div>

                @include('quotes.products.papers.view', ['pindex' => 0])
            </div>
        </div>
    @endfor
</div>