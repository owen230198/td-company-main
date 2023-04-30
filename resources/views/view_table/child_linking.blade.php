@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $field_title = @$select_data['field_title'] ?? 'name';
    $field_query = @$select_data['field_query'];
    $childs = \DB::table($select_data['table'])->where(['act' => 1, $field_query => $obj_id])->get($field_title);
@endphp
@foreach ($childs as $child)
<p class="color_main bg_eb px-3 py-1 radius_5 mb-2 text-center linking_table">
	{{ $child->{$field_title} }}
</p>
@endforeach