@include('Worker::commands.base_command_info')
@php
    $print_info = getPrintInfo(@$data_handle['type'], @$data_handle['color'], @$data_handle['machine'])
@endphp
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Kiểu in : <strong class="color_main ml-1">{{ $print_info['type'] }}.</strong>
</p>
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Màu in : <strong class="color_main ml-1">{{ $print_info['color'] }}.</strong>
</p>
<p class="d-flex align-items-center color_green mb-2">
    <i class="fa fa-asterisk mr-1 fs-14 color_yellow" aria-hidden="true"></i>
    Công nghệ in : <strong class="color_main ml-1">{{ $print_info['tech'] }}.</strong>
</p>