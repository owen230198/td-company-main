@extends('index')
@section('content')
    <div class=" row">
        <div class="col-6">
            <h3 class="fs-15 text-uppercase my-lg-4 my-3 text-center handle_title color_green mx-auto">
                {{ $title }}
            </h3>
            
        </div>
        <div class="col-6">
            <img src="{{ url('frontend/admin/images/manager.jpg') }}" alt="" class="w-100 mt-lg-4 mt-3">
        </div>
    </div>  
@endsection