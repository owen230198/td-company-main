<div class="list_table_func d-flex align-items-center">
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data->id.'') }}" class="table-btn" title="Sửa">
		<i class="fa fa-pencil-square-o fs-14" aria-hidden="true"></i>
	</a>
	<a href="{{ asset('clone/'.$tableItem['name'].'/'.$data->id.'') }}" class="table-btn mx-2" title="Chép">
		<i class="fa fa-clone fs-14" aria-hidden="true"></i>
	</a>
	<button type="button" title="Xóa" class="btn btn-primary table-btn color_red delete_btn bg_red" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data->id }}">
		<i class="fa fa-times fs-14" aria-hidden="true"></i>
	</button>
</div>