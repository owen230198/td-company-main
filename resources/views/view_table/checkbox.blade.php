<form action="{{ asset('do-update/'.$table_map.'/'.$id.'').'?ajax=1' }}" method="POST" class="baseAjaxForm">
	@csrf
	@include('view_update.checkbox')
</form>