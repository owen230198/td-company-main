<div class="mb-2 handle_after_print_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>Phần Sản xuất sau in</span>
    </h3>
@php
    $handle_stage = \App\Constants\TDConstant::HANDLE_STAGE;
@endphp
    <div class="quote_after_print_tab">
        <div class="d-flex">
            <div class="nav flex-column nav-pills  min_180 max_150 mr-3 bg_white" id="after-print-tab-pro{{ $j.'_'.$pindex }}" role="tablist" aria-orientation="vertical">
                @foreach ($handle_stage as $navkey => $nav)
                    <a class="nav-link text-right{{ $navkey == 0 ? ' active' : '' }}" id="v-{{ $nav['key'].'_'.$j.'_'.$pindex }}-tab" 
                    data-toggle="pill" href="#v-{{ $nav['key'].'_'.$j.'_'.$pindex }}" role="tab" 
                    aria-controls="v-{{ $nav['key'].'_'.$j.'_'.$pindex }}" aria-selected="true">
                        {{ $nav['note'] }}
                    </a>    
                @endforeach
            </div>
            <div class="tab-content p-3 w-100 bg_eb radius_5" id="after-print-tab-pro{{ $j.'_'.$pindex }}Content">
                @foreach ($handle_stage as $tabkey => $tab)
                    <div class="tab-pane fade show{{ $tabkey == 0 ? ' active' : '' }}" id="v-{{ $tab['key'].'_'.$j.'_'.$pindex }}" 
                    role="tabpanel" aria-labelledby="v-{{ $tab['key'].'_'.$j.'_'.$pindex }}-tab">
                        @include('quotes.products.papers.handles.'.$tab['key'])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>