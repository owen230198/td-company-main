@php
    $file = !empty($value) ? json_decode($value, true) : [];
    $file_exists = !empty($file) && file_exists(getFullPathFileUpload(@$file['path']));
@endphp
<div class="d-flex align-items-center __module_upload_file">
    <input type="hidden" name="{{ @$name }}" value="{{ @$value }}" class="__file_value">
    @include('view_table.file')
    @if ((!empty($other_data['role_update']) && in_array(\GroupUser::getCurrent(), $other_data['role_update'])) || empty($other_data['role_update']) || \GroupUser::isAdmin())
        <div class="upload_click position-relative mr-2">
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                <i class="fa fa-upload mr-2 fs-14" aria-hidden="true"></i>Chọn file
            </button>
            <input type="file" class="upload_input __file_upload_input" 
            data-table={{ @$table_map }} 
            data-field = {{ @$other_data['field_name'] ?? @$name }}
            data-obj = {{ @$other_data['obj_id'] }}>
        </div>
    @endif
</div>