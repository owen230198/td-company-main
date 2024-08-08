<form action="{{ url('Worker/action-command/feedback') }}" method="POST" class="w-100 baseAjaxForm" enctype="multipart/form-data">
    @csrf
    
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Phản hồi gia công</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
                $supply = getDetailDataObject($data_command->table_supply, $data_command->supply);
                $type = @$data_command->type;
                $handle = !empty($supply->{$type}) ? json_decode($supply->{$type}, true) : [];
            @endphp
            @include('managers.worker_feedbacks.form_data', ['value' => $handle])
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" disabled class="btn btn-primary bg_green color_white main_btn">Gửi phản hồi</button>
        </div>
    </div>
</form>