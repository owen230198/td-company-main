@php
    $file = !empty($value) ? json_decode($value, true) : [];
    $file_exists = !empty($file) && file_exists(getFullPathFileUpload(@$file['path']));
@endphp
<div class="d-flex align-items-center {{ empty($history_view) ? 'justify-content-center' : '' }}">
    @if ($file_exists)
        <a href="{{ url('file-download?id='.@$file['id']) }}" title = "{{ @$file['name'] }}"
        class="main_button color_white bg_green border_green radius_5 font_bold smooth mr-2">
            <i class="fa fa-download fs-14 mr-2" aria-hidden="true"></i>
            {{limitStr(@$file['name'], 18, 0) }}
        </a>
    @else
        <p class="font-italic color_main">Không có file !</p>
    @endif
</div>