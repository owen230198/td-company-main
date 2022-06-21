@php
	$id = @$_id?$_id:0;
	$kh = new \App\Http\Controllers\KController;
	$permissionUpdateGuide = $kh->checkPermissionAction('guides', 'update');
@endphp
<div class="modal-header">
	<h3 class="modal-title fs-20" id="guideModalLongTitle">
		{{ @$title?$title:'Hướng Dẫn Người Dùng' }}
		@if (@$permissionUpdateGuide)
		<a href="{{ asset('update/guides/'.$id.'') }}" class="ml-2 fs-13">chỉnh sửa</a>
		@endif
	</h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	{!! @$content !!}
</div>