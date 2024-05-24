@extends('print_data.index')
@section('content')
@php
    $arr_tables = ['papers', 'supplies', 'fill_finishes']
@endphp
    @foreach ($arr_tables as $table)
        @if (!empty($data_table[$table]))
            <div class="mb-5 pb-5 border_bottom_green">
                @foreach ($data_table[$table] as $data)
                    <div class="mb-4 pb-4 border_bot_main">
                        @include('print_data.'.$table.'.detail', ['data_item' => $data])
                    </div>
                @endforeach 
            </div>
        @endif
    @endforeach
@endsection