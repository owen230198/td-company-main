<div class="mb-2 handle_after_print_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>Phần công đoạn sản xuất in & sau in</span>
    </h3>
@php
    $category =  @$cate == \TDConst::HARD_BOX ? 1 : 2;
    $handle_stage =  @$category == 1 ? \TDConst::HANDLE_STAGE_HARD : \TDConst::HANDLE_STAGE
@endphp
    <div class="quote_after_print_tab">
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
                    <div class="tab-pane fade show{{ $tabkey == 0 ? ' active' : '' }}" id="v-{{ $tab['key'].'_'.$pro_index.'_'.$supp_index }}" 
                    role="tabpanel" aria-labelledby="v-{{ $tab['key'].'_'.$pro_index.'_'.$supp_index }}-tab">
                        @include('quotes.products.papers.handles.'.$tab['key'])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>