<div class="mb-2 handle_after_print_config">
    <h3 class="fs-14 text-uppercase border_top_eb pt-3 mt-3 text-center quote_handle_title">
        <span>Phần Sản xuất sau in</span>
    </h3>
@php
    $handle_stage = \App\Constants\TDConstant::HANDLE_STAGE;
@endphp
    <div class="quote_after_print_tab">
        <div class="d-flex">
            <div class="nav flex-column nav-pills  min_150 max_150 mr-3 bg_white" id="after-print-tab-pro{{ $j.'_'.$pindex }}" role="tablist" aria-orientation="vertical">
                @foreach ($handle_stage as $item)
                    
                @endforeach
            </div>
            <div class="tab-content p-3 w-100 bg_eb radius_5" id="after-print-tab-pro{{ $j.'_'.$pindex }}Content">
                <div class="tab-pane fade show active" id="v-print_type_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-print_type_{{ $j.'_'.$pindex }}-tab">
                    @include('quotes.products.papers.handles.print')
                </div>
                <div class="tab-pane fade" id="v-nilon_cover_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-nilon_cover_{{ $j.'_'.$pindex }}-tab">
                    @include('quotes.products.papers.handles.nilon')
                </div>
                <div class="tab-pane fade" id="v-metalai_cover_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-metalai_cover_{{ $j.'_'.$pindex }}-tab">
                    @include('quotes.products.papers.handles.metalai')
                </div>
                <div class="tab-pane fade" id="v-glossy_compress_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-glossy_compress_{{ $j.'_'.$pindex }}-tab">
                    @include('quotes.products.papers.handles.compress')
                </div>
                <div class="tab-pane fade" id="v-floating_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-floating_{{ $j.'_'.$pindex }}-tab">
                    Thúc nổi
                </div>
                <div class="tab-pane fade" id="v-uv_print_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-uv_print_{{ $j.'_'.$pindex }}-tab">
                    In lưới UV
                </div>
                <div class="tab-pane fade" id="v-elevated_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-elevated_{{ $j.'_'.$pindex }}-tab">
                    Máy bế
                </div>
                <div class="tab-pane fade" id="v-box_paste_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-box_paste_{{ $j.'_'.$pindex }}-tab">
                    Máy dán hộp giấy
                </div>
                <div class="tab-pane fade" id="v-temp_plus_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-temp_plus_{{ $j.'_'.$pindex }}-tab">
                    Phát sinh tem toa
                </div>
                <div class="tab-pane fade" id="v-other_plus_{{ $j.'_'.$pindex }}" role="tabpanel" aria-labelledby="v-other_plus_{{ $j.'_'.$pindex }}-tab">
                    Phát sinh khác
                </div>
            </div>
        </div>
    </div>
</div>