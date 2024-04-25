@php
    $field_searchs = \App\Models\PrintWarehouse::FIELD_SEARCH;
@endphp
@include('table.form_search', ['field_searchs' => $field_searchs])