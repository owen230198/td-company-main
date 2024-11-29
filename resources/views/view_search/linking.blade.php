{{-- @php
    $n_other_data = $other_data;
    $n_other_data['config']['multiple'] = true;
@endphp --}}
@include('view_update.linking', [
    'value' => @$data_search[$name], 
    'is_search' => 1, 
    'dataItem' => @$data_search
    ])