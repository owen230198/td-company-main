@foreach ($stages as $stage)
    @php
        $stage_key = $stage['key'];
        $arr_stage = !empty($data_item->{$stage_key}) ? json_decode($data_item->{$stage_key}, true) : [];
        if ($stage_key == \TDConst::ELEVATE && !empty($arr_stage['float']['act'])) {
            $note = $stage['note'].' & thúc nổi';
        }else{
            $note = $stage['note'];
        }
    @endphp
    @if (!empty($arr_stage['act']))
        @include('print_data.info_item', ['name' => $note, 'info' => getTextdataPaperStage($stage_key, $arr_stage), 'note' => @$arr_stage['note']])        
    @endif
@endforeach
@include('print_data.info_item', ['name' => 'Số lượng thành phẩm', 'info' => getFieldDataById('qty', 'products', $data_item->product)]) 