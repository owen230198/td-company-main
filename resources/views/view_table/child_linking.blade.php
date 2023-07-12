@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_query = @$select_data['field_query'];
    $childs = \DB::table($select_data['table'])->where(['act' => 1, $field_query => $obj_id])->get();
    $child_field = \DB::table('n_detail_tables')->where(['act' => 1, 'table_map' => $select_data['table'], 'name' => $field_title])->first();
@endphp
@foreach ($childs as $child)
	@if (!empty($child_field))
        @php
            $arr = (array) $child_field;
            $arr['obj_id'] = $child->id;
            $arr['value'] = @$child->{$field_title};
            $arr['other_data'] = !empty($child_field['other_data']) ? json_decode($child_field['other_data'], true) : [];
        @endphp
        <div class="mb-1">
            @include('view_table.'.$child_field['type'], $arr)
        </div>
    @else
        <p class="color_main radius_5 mb-2 text-center linking_table">
            {{ $child->{$field_title} }}
        </p>
    @endif
@endforeach