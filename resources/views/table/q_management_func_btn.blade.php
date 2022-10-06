<div class="d-flex flex-wrap justify-content-center">
	<button class="table-btn my-1 fs-20 mr-mx-1 load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="update-detail-quotes/{{ $tableItem['name'].'/'.$data_quotes['id'] }}/{{ $data['id'] }}">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	</button>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn my-1 mr-mx-1">
		<i class="fa fa-clone fs-20" aria-hidden="true"></i>
	</a>
	<button type="button" class="btn btn-primary table-btn my-1 color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-20" aria-hidden="true"></i>
	</button>
</div>