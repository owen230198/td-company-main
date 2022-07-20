<div class="d-flex flex-wrap justify-content-center">
	<a href="{{ asset('update/'.$tableItem['name'].'/'.$data['id'].'') }}" class="table-btn mb-2 fs-20 mr-2">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	</a>
	<a href="quote-managements/q_papers/{{ $data['id'] }}" class="table-btn mb-2 fs-20 mr-2">
		<i class="fa fa-list-ol" aria-hidden="true"></i>
	</a>
	<a href="file-details/{{ $data['id'] }}" class="table-btn mb-2 fs-20 mr-2">
		<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
	</a>
	<button type="button" class="btn btn-primary table-btn mb-2 color_red delete_btn" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data['id'] }}">
		<i class="fa fa-times fs-20" aria-hidden="true"></i>
	</button>
</div>