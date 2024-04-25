@extends('table.base_table')
@section('type')
    <div class="ajax_data_ingredient">
        @include('table.table_base_view')
    </div>
@endsection
@push('bottom-scripts')
    <script src="{{ asset('frontend/admin/script/order.js') }}"></script>
@endpush