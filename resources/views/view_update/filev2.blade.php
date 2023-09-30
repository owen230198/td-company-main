<div class="form-control file_upload_v2_module">
    <div id="upload-container" class="text-center d-flex align-items-center">
        <input type="hidden" name="{{ @$name }}" value="{{ @$value }}" class="__file_value">
        @include('view_table.file')
        @if ((!empty($other_data['role_update']) && in_array(\GroupUser::getCurrent(), $other_data['role_update'])) || empty($other_data['role_update']) || \GroupUser::isAdmin())
            <button type="button" class="btn btn-primary __browse_file_v2_button font_bold">
                <i class="fa fa-upload mr-2 fs-14" aria-hidden="true"></i>
                Chọn file
            </button>
        @endif
    </div>
    <div class="progress mt-3" style="height: 25px; display:none">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
    </div>
</div>