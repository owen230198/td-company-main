@php
    $data_select_fill = [
        'other_data' => [
            'config' => ['search' => 1], 
            'data' => ['table' => 'supply_prices', 'where' => ['type' => \TDConst::FILL]]
        ],
        'note' => 'Tên giấy bồi',
        'value' => @$fill_data['materal'],
        'name' => 'product['.$pro_index.'][fill_finish][fill][stage]['.$findex.'][materal]'
    ]
@endphp
<div class="d-flex align-items-center mb-2 fs-13 quote_fill_finish_item position-relative" data-index={{ $findex }}>
    @if ($findex > 0)
        <span class="remove_ext_element_quote d-flex remove_ff_quote color_red smooth"><i class="fa fa-times" aria-hidden="true"></i></span> 
    @endif
    <label class="mb-0 min_210 text-capitalize text-right mr-3">
        @php
            $num = $findex + 1;
        @endphp
        ĐG các công đoạn bồi hộp {{ $findex > 0 ? '('.$num.')' : '' }}
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <input type="number" name = 'product[{{ $pro_index }}][fill_finish][fill][stage][{{ $findex }}][length]' placeholder="KT chiều dài (cm)" 
        class="form-control medium_input" step="any" value="{{ @$fill_data['length'] }}"> 
        <span class="mx-3">X</span>
        <input type="number" name = 'product[{{ $pro_index }}][fill_finish][fill][stage][{{ $findex }}][width]' placeholder="KT chiều rộng (cm)" 
        class="form-control medium_input" step="any" value="{{ @$fill_data['width'] }}"> 
        <span class="mx-2">||</span> 
        <div class="medium_input">
            @include('view_update.linking', $data_select_fill)
        </div>
    </div>
</div>