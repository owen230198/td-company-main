@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $list_options = !empty($select_data['options']) ? $select_data['options'] : [];
@endphp
<p class="color_main radius_5 mb-0 text-center linking_table">
	{{ !empty($list_options[$value]) ? $list_options[$value] : 'Không xác định' }}
</p>