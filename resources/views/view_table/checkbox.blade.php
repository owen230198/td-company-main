<form action="{{ asset('update/'.$table_map.'/'.$obj_id.'') }}" method="POST" class="change_submit checkbox_module">
	@csrf
	@include('view_update.checkbox')
</form>