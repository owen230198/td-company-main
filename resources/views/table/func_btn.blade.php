<div class="list_table_func d-flex align-items-center justify-content-center">
	@php
		$ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
 	@endphp
	@if (!empty($ext_action))
		@foreach ($ext_action as $button)
			@if (!empty($button['condition']) && getBoolByCondArr($button['condition'], (array) $data))
				@if (@$button['type'] == 2)
					<button type="button" class="table-btn mr-2 mb-2 {{ @$button['class'] }}" title="{{ @$button['note'] }}" data-table="{{ $tableItem['name'] }}" data-id="{{ $data->id }}">
						<i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
					</button>
				@else
					<a href="{{ url(@$button['link'].''.$data->id) }}" class="table-btn mr-2 mb-2" title="{{ @$button['note'] }}">
						<i class="fa fa-{{ $button['icon'] }} fs-14" aria-hidden="true"></i>
					</a>
				@endif	
			@endif
		@endforeach
	@endif
	@if ($tableItem['update'] == 1)
		<a href="{{ asset('update/'.$tableItem['name'].'/'.$data->id.''.@$param_action) }}" class="table-btn mr-2 mb-2" title="Sửa">
			<i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
		</a>
	@endif
	@if ($tableItem['copy'] == 1)
		
	@endif
	@if ($tableItem['remove'] == 1)
		<button type="button" title="Xóa" class="btn btn-primary mb-2 table-btn delete_btn bg_red" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data->id }}">
			<i class="fa fa-times fs-14" aria-hidden="true"></i>
		</button>
	@endif
</div>