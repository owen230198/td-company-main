@extends('index')
@section('content')
    <div class="dashborad_content">
        @foreach ($list_data as $data)
            @include('histories.item',  ['history' => $data, 'type_detail' => 'collapse'])
        @endforeach
    </div>
@endsection
