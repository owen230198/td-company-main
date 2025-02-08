@extends('index')
@section('content')
    <div class="dashborad_content position-relative pb-5 base_content pl-0 pt-3">
        <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
            @csrf
            @foreach ($fields as $field)
                @include('view_update.view', $field)
            @endforeach
            @include('action.list_button')
        </form>
    </div>
@endsection