@extends('index')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/admin/css/quote.css') }}">
@endsection
@section('content')
    <div class="dashborad_content config_content ">
        <form action="" method="GET" class="mb-0 baseAjaxForm">
            @foreach ($info_fields as $iField)
                @php
                    $iField['attr']['readonly'] = 1;
                    $iField['name'] = 'warehouse['.$iField['name'].']';
                @endphp
                @if (!empty($iField['value']))
                    @include('view_update.view', $iField)
                @endif
            @endforeach
            @include('view_update.view', $field_chose_type)
            <div class="ajax_data_inventory">
                
            </div>
            @include('view_update.view', $receipt_field)
        </form>  
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endsection
