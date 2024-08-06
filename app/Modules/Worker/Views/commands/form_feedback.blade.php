<form action="{{ url('Worker/action-command/feedback') }}" method="POST" class="w-100 baseAjaxForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ @$data_command->id }}">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Phản hồi gia công</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
                $path = 'Worker::commands.feedbacks.'.@$data_command->type;
            @endphp
            @if (view()->exists($path))
                @include($path)  
            @endif
            <div class="form-group d-flex mb-2">
                <label class="mb-0 min_150 fs-13 text-capitalize justify-content-end mr-3 d-flex mt-1">
                    Hệ số lượt đúng
                </label>
                <select name="factor" class="form-control">
                    @for ($i = 1; $i <= 6;  $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" disabled class="btn btn-primary bg_green color_white main_btn">Gửi phản hồi</button>
        </div>
    </div>
</form>