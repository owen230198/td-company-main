<li class="supply_item">
    @if (!empty($supply['device']))
        <ul class="supply_info">
            @if ($supply['pro_field'] != \TDConst::FILL_FINISH)
                <li class="supply_item_inf">
                    <span class="font_bold mr-1">Tên vật tư: </span>
                    <span>{{ getTitleSupplyByType($supply['pro_field'],$item) }}</span>
                </li>   
            @endif
            @foreach ($supply['device'] as $key => $device)
                @php
                    $stage = !empty($item->{$key}) ? json_decode($item->{$key}, true) : [];
                    $stage_cover = [];
                    $key_stage_cover = \TDConst::COVER;
                    $hasCover = $key == \TDConst::METALAI && !empty($item->{$key_stage_cover});
                    if ($hasCover) {
                        $stage_cover = json_decode($item->{$key_stage_cover}, true);
                    }
                    $size = !empty($item->size) ? json_decode($item->size, true) : [];
                    $cost = @$stage['total'] ?? 0;
                @endphp
                @if ($cost > 0)
                    <li class="supply_item_inf cursor_pointer position-relative">
                        <div class="supp_cost_name">
                            @if ($hasCover && !empty($stage_cover['total']))
                                @php
                                    $device .= ' & cán phủ trên';
                                    $cost += $stage_cover['total']; 
                                @endphp   
                            @endif
                            <span class="font_bold mr-1">{{ $device }}: </span>
                            <span>{{ number_format($cost) }}đ</span>
                        </div>
                        <div class="detail_quote_supply_item">
                            <p class="mb-2 fs-15 font_bold color_green text-center text-capitalize">Chi Tiết Chi Phí {{ $device }}</p>
                            @include('quotes.profits.'.$supply['table'].'/'.$key, ['stage' => $stage, 'size' => $size])
                        </div> 
                    </li>
                @endif
            @endforeach
            <li class="supply_item_inf">
                <span class="font_bold mr-1">Chi phí : </span>
                <span class="font_bold color_red">{{ number_format((int) @$item->total_cost) }}đ</span>
            </li>
        </ul>
    @endif
</li>