<div class="mb-2 handle_after_print_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center handle_title">
        <span>Phần công đoạn sản xuất in & sau in</span>
    </h3>
@php
    $cate = !empty($data_paper->ext_cate) ? $data_paper->ext_cate : @$cate;
    $key_supp = \TDConst::PAPER;
    $paper_hd_base_name = @$paper_hd_base_name ?? 'product['.$pro_index.'][paper]['.$supp_index.']';
    $handle_stage =  getAfterPrintStageByCate(@$cate);
@endphp
    <div class="quote_after_print_tab">
        <input type="hidden" name="product[{{ $pro_index }}][paper][{{ $supp_index }}][ext_cate]" value="{{ $cate }}">
        <div class="d-flex">
            <div class="nav flex-column nav-pills  min_210 max_150 mr-3 bg_white" id="after-print-tab-pro{{ $pro_index.'_'.$supp_index }}" role="tablist" aria-orientation="vertical">
                @foreach ($handle_stage as $navkey => $nav)
                    <a class="nav-link text-right {{ $navkey == 0 ? $nav['color'].'_stage active' : $nav['color'].'_stage' }}" 
                    id="v-{{ $nav['key'].'_'.$pro_index.'_'.$supp_index }}-tab" 
                    data-toggle="pill" href="#v-{{ $nav['key'].'_'.$pro_index.'_'.$supp_index }}" role="tab" 
                    aria-controls="v-{{ $nav['key'].'_'.$pro_index.'_'.$supp_index }}" aria-selected="true">
                        {{ $nav['note'] }}
                    </a>    
                @endforeach
            </div>
            <div class="tab-content p-3 w-100 bg_eb radius_5" id="after-print-tab-pro{{ $pro_index.'_'.$supp_index }}Content">
                @foreach ($handle_stage as $tabkey => $tab)
                    @php
                        $tab_key = $tab['key'];
                        $data_handle = !empty($data_paper->{$tab_key}) ? json_decode($data_paper->{$tab_key}, true) : [];
                        if ($tab_key == \TDConst::METALAI) {
                            $data_handle_cover = !empty($data_paper->cover) ? json_decode($data_paper->cover, true) : [];
                        }
                    @endphp
                    <div class="tab-pane fade show{{ $tabkey == 0 ? ' active' : '' }}" id="v-{{ $tab_key.'_'.$pro_index.'_'.$supp_index }}" 
                    role="tabpanel" aria-labelledby="v-{{ $tab_key.'_'.$pro_index.'_'.$supp_index }}-tab">
                        @include('quotes.products.papers.handles.'.$tab_key, ['data_handle' => $data_handle, 'data_handle_cover' => @$data_handle_cover])
                        @php
                        $textarea_note = [
                                'name' => 'product['.$pro_index.'][paper]['.$supp_index.']['.$tab_key.'][note]',
                                'type' => 'textarea',
                                'note' => 'Ghi chú',
                                'value' => @$data_handle['note']
                            ];
                        @endphp
                        @include('view_update.view', $textarea_note)
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>