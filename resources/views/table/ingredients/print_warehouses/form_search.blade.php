@php
    $field_searchs = \App\Models\PrintWarehouse::getFieldSearch();
@endphp
<div class="form_search_ingredient">
    @include('table.form_search', ['field_searchs' => $field_searchs, 'ext_params' => ['get_table_view_ajax' => 'table_base_view']]) 
</div>