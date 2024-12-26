@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_query = @$select_data['field_query'];
    $field_linking = !empty($select_data['field_linking']) ? $select_data['field_linking'] : 'id';
    $model_linking = getModelByTable($select_data['table']);
    $childs = $model_linking::where(['act' => 1, $field_query => $data->{$field_linking}])->get();
@endphp
@foreach ($childs as $child)
    @php
        $label = method_exists($model_linking, 'getLabelLinking') ? $model_linking::getLabelLinking($child) : $child->{$field_title};
    @endphp
    <p class="color_main radius_5 mb-2 text-center">
        {{ $label }}
    </p>
@endforeach