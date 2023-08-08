<form action="{{ asset('update/'.$table_map.'/'.$obj_id.'') }}" method="POST" class="checkbox_module baseAjaxForm">
	@csrf
	@include('view_update.checkbox')
</form>