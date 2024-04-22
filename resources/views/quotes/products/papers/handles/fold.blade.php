@php
    $key_stage = \TDConst::FOLD;
@endphp
@include('quotes.products.papers.handles.select_device', ['key_device' => $key_stage, 'value' => @$data_handle['machine']])