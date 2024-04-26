@php
    $field_searchs = \App\Models\PrintWarehouse::getFieldSearch();
@endphp
@include('table.form_search', ['field_searchs' => $field_searchs])