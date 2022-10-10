<div class="list_table_func">
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn fs-13">
		<i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i>
		Sửa
	</a>
	<a href="quote-managements/q_papers/{{ $data['id'] }}" class="table-btn fs-13">
		<i class="fa fa-list-ol mr-1" aria-hidden="true"></i>
		Thiết bị
	</a>
	<a href="file-details/{{ $data['id'] }}" class="table-btn fs-13">
		<i class="fa fa-file-pdf-o mr-1" aria-hidden="true"></i>
		File PDF
	</a>
	<button type="button" class="btn btn-primary table-btn color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-13 mr-1" aria-hidden="true"></i>
		Xóa
	</button>
</div>