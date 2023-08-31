@foreach ($child as $field_child)
    @include('view_search.view', ['field' => $field_child])
@endforeach 