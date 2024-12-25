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
	@if (!empty($tableItem['copy']))
		@include('table.btn_copy')
	@endif
	@if ($tableItem['remove'] == 1)
		@include('table.btn_remove')
	@endif
</div>