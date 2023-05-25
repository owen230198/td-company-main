@php
    $file = !empty($value) ? json_decode($value, true) : [];
@endphp
<div class="d-flex align-items-center __module_upload_file">
    <input type="hidden" name="{{ $name }}" value="{{ @$value }}" class="__file_value">
    <div class="__file_preview m-2 p-2 border_main text-center radius_5" style="display:{{ !empty($value) ? 'block' : 'none' }}">
        <i class="fa fa-file-archive-o fs-30" aria-hidden="true"></i>
        <p class="fs-13 font_bold __file_name">{{ subStringLimit(@$file['name'], 20) }}</p>
    </div>
    @if (!empty($file))
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2 __file_download" data-path="{{ @$file['path'] }}">
            <i class="fa fa-download mr-2 fs-14" aria-hidden="true"></i>Download
        </button>   
    @endif
    <div class="upload_click position-relative mr-2">
        <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold smooth">
            <i class="fa fa-upload mr-2 fs-14" aria-hidden="true"></i>Chọn file
        </button>
        <input type="file" class="upload_input __file_upload_input">
    </div>
    <button type="button" class="main_button bg_red color_white radius_5 font_bold smooth red_btn" data-path="{{ @$file['path'] }}">
        <i class="fa fa-times fs-14" aria-hidden="true"></i>
    </button>
</div>