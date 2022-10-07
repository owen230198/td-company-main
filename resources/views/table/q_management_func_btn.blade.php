<div class="d-flex flex-wrap justify-content-center">
	<button class="table-btn mx-1 my-1 fs-13 mr-mx-1 load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="update-detail-quotes/{{ $tableItem['name'].'/'.$data_quotes['id'] }}/{{ $data['id'] }}">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	</button>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn mx-1 my-1 mr-mx-1">
		<i class="fa fa-clone fs-13" aria-hidden="true"></i>
	</a>
	<button type="button" class="btn mx-1 btn-primary table-btn my-1 color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-13" aria-hidden="true"></i>
	</button>
</div>