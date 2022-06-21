<form action="{{ asset('do-update/'.$field['map_document'].'/'.$data['id'].'') }}" method="POST" class="baseAjaxForm">
	@csrf
	<div class="checkbox_module">
		<input type="hidden" name="{{ $field['name'] }}" value = "{{ $data[$field['name']] }}">
		<input type="checkbox" class="toggle mx-auto change_submit" {{  $data[$field['name']]=='1'?'checked':'' }}/>
	</div>
</form>