<div class="list_table_func d-flex align-items-center justify-content-center">
	@php
		$ext_action = !empty($tableItem['ext_action']) ? json_decode($tableItem['ext_action'], true) : []
 	@endphp
	@if (!empty($ext_action))
		@foreach ($ext_action as $button)
			@if (empty($button['detailonly']))
				@if (!empty($button['condition']))
					@if (getBoolByCondArr($button['condition'], (array) $data))
						@include('table.ext_func_btn')	
					@endif
				@else
					@include('table.ext_func_btn')		
				@endif		
			@endif
		@endforeach
	@endif
	@if ($tableItem['update'] == 1)
		@include('table.btn_update')
	@endif
	@if ($tableItem['copy'] == 1)
		<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data->id.''.@$param_action) }}" class="table-btn mr-2 mb-2" title="Sao chép {{ $tableItem['note'] }}">
			<i class="fa fa-clone fs-14" aria-hidden="true"></i>
		</a>	
	@endif
	@if ($tableItem['remove'] == 1)
		@include('table.btn_remove')
	@endif
</div>