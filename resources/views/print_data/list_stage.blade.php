@foreach ($stages as $stage)
    @php
        $arr_stage = !empty($data_item->{$stage['key']}) ? json_decode($data_item->{$stage['key']}, true) : [];
    @endphp
    @if (!empty($arr_stage['act']))
        @include('print_data.info_item', ['name' => $stage['note'], 'info' => getTextdataPaperStage($stage['key'], $arr_stage), 'note' => @$arr_stage['note']])        
    @endif
@endforeach
@include('print_data.info_item', ['name' => 'Số lượng thành phẩm', 'info' => getFieldDataById('qty', 'products', $data_item->product)]) 