@php
    $file = !empty($value) ? json_decode($value, true) : [];
    $file_exists = !empty($file) && file_exists(getFullPathFileUpload(@$file['path']));
@endphp
<div class="d-flex align-items-center __module_upload_file">
    <input type="hidden" name="{{ $name }}" value="{{ @$value }}" class="__file_value">
    <div class="__file_preview m-2 p-2 border_main text-center radius_5" style="display:{{ $file_exists ? 'block' : 'none' }}">
        <i class="fa fa-file-archive-o fs-30" aria-hidden="true"></i>
        <p class="fs-13 font_bold __file_name">{{ mb_strimwidth(@$file['name'], 0, 18, '...') }}</p>
    </div>
    @if ($file_exists)
        <a href="{{ url('file-download?path='.@$file['path']) }}" title = "{{ @$file['name'] }}"
        class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
            <i class="fa fa-download mr-2 fs-14" aria-hidden="true"></i>Download
        </a>   
    @endif
    @if ((!empty($other_data['role_update']) && in_array(\GroupUser::getCurrent(), $other_data['role_update'])) || empty($other_data['role_update']) || \GroupUser::isAdmin())
        <div class="upload_click position-relative mr-2">
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                <i class="fa fa-upload mr-2 fs-14" aria-hidden="true"></i>Chọn file
            </button>
            <input type="file" class="upload_input __file_upload_input" 
            data-table={{ @$table_map }} 
            data-field = {{ @$other_data['field_name'] ?? $name }}
            data-obj = {{ @$other_data['obj_id'] }}>
        </div>
    @endif
</div>