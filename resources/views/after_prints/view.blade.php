@extends('index')
@section('content')
    <div class="dashborad_content position-relative">
        <form action="{{ url('after-print-kcs/'.$dataItem->id) }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @foreach ($fields as $field)
                @include('view_update.view', $field)
            @endforeach
            @include('action.list_button')
        </form>
    </div>
@endsection