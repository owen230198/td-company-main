<div class="list_table_func d-flex align-items-center justify-content-center">
	@php
		$ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
 	@endphp
	@if (!empty($ext_action))
		@foreach ($ext_action as $button)
			<a href="{{ url(@$button['link'].''.$data->id) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}">
				<i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
			</a>	
		@endforeach
	@endif
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data->id.''.@$param_action) }}" class="table-btn mr-2 mb-2" title="Sửa">
		<i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
	</a>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data->id.''.@$param_action) }}" class="table-btn mr-2 mb-2" title="Chép">
		<i class="fa fa-clone fs-14" aria-hidden="true"></i>
	</a>
	<button type="button" title="Xóa" class="btn btn-primary mb-2 table-btn delete_btn bg_red" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data->id }}">
		<i class="fa fa-times fs-14" aria-hidden="true"></i>
	</button>
</div>