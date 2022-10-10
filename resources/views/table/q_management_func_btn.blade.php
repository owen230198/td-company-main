<div class="list_table_func">
	<button class="table-btn fs-13 load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="update-detail-quotes/{{ $tableItem['name'].'/'.$data_quotes['id'] }}/{{ $data['id'] }}">
		<i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i>
	</button>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn">
		<i class="fa fa-clone fs-13 mr-1" aria-hidden="true"></i>
	</a>
	<button type="button" class="btn btn-primary table-btn color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-13 mr-1" aria-hidden="true"></i>
	</button>
</div>