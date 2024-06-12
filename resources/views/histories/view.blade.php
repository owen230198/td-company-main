@extends('index')
@section('content')
    <div class="dashborad_content">
        @foreach ($list_data as $data)
            @dump($data->toArray());
        @endforeach
    </div>
@endsection
