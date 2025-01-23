<form action="{{ url('Worker/action-command/submit') }}" method="POST" class="w-100 baseAjaxForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ @$data_command->id }}">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Nhập số lượng đã hoàn thành</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group d-flex mb-2">
                <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
                    Số lượng hoàn thành
                </label>
                <input type="number" name="qty" class="form-control" min="1" value="{{ @$data_command->qty }}" placeholder="Hoàn thành hết">
            </div>
            <div class="form-group d-flex mb-2">
                <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
                    Số lượng thừa
                </label>
                <input type="number" name="exess" class="form-control" min="1" value="0" >
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" disabled class="btn btn-primary bg_green color_white main_btn">Chấm công</button>
        </div>
    </div>
</form>