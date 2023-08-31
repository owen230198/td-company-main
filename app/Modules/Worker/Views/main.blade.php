@extends('Worker::index')
@section('content')
    <div class="row my-4">
        <div class="col-lg-6 border_right_green">
            <div class="main_worker_home">
                <h3 class="fs-14 text-uppercase border_bot_eb pb-1 mb-1 text-center handle_title color_green mx-auto">
                    Danh sách lệnh 
                    <a href="{{ url()->current() }}"><i class="fa fa-refresh ml-2 fs-14 color_green" aria-hidden="true"></i></a>
                </h3>   
            </div> 
            <form action="{{ url()->current() }}" method="GET" class="mt-3 mb-4 form_search position-relative">
                <input type="text" name="q" value={{ @$key_search }}>
                <button type="submit" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                    <i class="fa fa-search fs-14" aria-hidden="true"></i>
                </button>
            </form>
            <div class="list_worker_command">
                <div class="row row-10">
                    @if (!empty($list_data))
                        @foreach ($list_data as $item)
                            @if (!empty($item->{$worker['type']}))
                                @php
                                    $data = json_decode($item->{$worker['type']}, true);
                                @endphp
                                <div class="col-lg-6 mb_20">
                                    @include('Worker::commands.items/'.$item_command, ['supply' => $item, 'command' => $data, 'key_type' => $worker['type']])
                                </div>
                            @endif
                        @endforeach  
                    @endif
                </div>
            </div>
        </div>
    </div>       
@endsection