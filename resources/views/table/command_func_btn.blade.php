<div class="list_table_func">
	<a href="{{ asset('view-command/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn fs-13">
		<i class="fa fa-eye" aria-hidden="true"></i>
		Xem
	</a>
	@if (@$data['status'] == 'not_accepted')
		<a href="{{ asset('received-command/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn">
			<i class="fa fa-download fs-13 mr-1" aria-hidden="true"></i>
			Tiếp nhận
		</a>
	@else
		<a href="{{ asset('apply-command/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn">
			<i class="fa fa-check fs-13 mr-1" aria-hidden="true"></i>
			Hoàn thành
		</a>
	@endif
</div>