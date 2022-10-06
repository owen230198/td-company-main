<div class="d-flex flex-wrap justify-content-center">
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn my-1 fs-13 mx-1">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	</a>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn my-1 mx-1">
		<i class="fa fa-clone fs-13" aria-hidden="true"></i>
	</a>
	<button type="button" class="btn btn-primary table-btn my-1 mx-1 color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-13" aria-hidden="true"></i>
	</button>
</div>