@extends('index')
@section('content')
    @include('warehouses.actions.form_action')
    @if (!empty($data_item_log))
        @include('warehouses.actions.histories.view')
    @endif
@endsection
