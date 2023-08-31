<div class="modal fade" id="worker-submit-modal" tabindex="-1" role="dialog" aria-labelledby="worker-submit-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ url('Worker/action-command/submit') }}" method="POST" class="w-100 baseAjaxForm" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="table" value="{{ @$data_command->table }}">
			<input type="hidden" name="id" value="{{ @$data_command->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group d-flex mb-2">
                        <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
                            Số lượng hoàn thành
                        </label>
                        <input type="number" class="form-control" min="1" value=""
                            placeholder="Hoàn thành hết">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary bg_green color_white main_btn">Chấm công</button>
                </div>
            </div>
        </form>
    </div>
</div>
