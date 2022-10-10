<div class="list_table_func">
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn fs-13">
		<i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i>
		Sửa
	</a>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn">
		<i class="fa fa-clone fs-13 mr-1" aria-hidden="true"></i>
		Chép
	</a>
	<button type="button" class="btn btn-primary table-btn color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-13 mr-1" aria-hidden="true"></i>
	</button>
	Xóa
</div>