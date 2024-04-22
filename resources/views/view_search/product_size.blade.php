@php
    $base_name = 'size';
    $data_value = !empty($data_search['size']) ? $data_search['size'] : [];
@endphp
<div class="d-flex align-items-center">
    <input type="number" name = '{{ $base_name }}[length]'  placeholder="Dài" class="form-control short_input text-center" step="any" value="{{ @$data_value['length'] }}">
    <span class="mx-2">X</span>
    <input type="number" name = '{{ $base_name }}[width]'  placeholder="Rộng" class="form-control short_input text-center" step="any" value="{{ @$data_value['width'] }}">
    <span class="mx-2">X</span>
    <input type="number" name = '{{ $base_name }}[height]'  placeholder="Cao" class="form-control short_input text-center" step="any" value="{{ @$data_value['height'] }}">
</div>