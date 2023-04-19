@php
    $listCheckbox = json_decode($field['default_data'], true);
    $name = @$field['name']?$field['name']:'';
	$jsonValue = @$data[$name]?$data[$name]:0 ;
    $value = json_decode($jsonValue, true);
@endphp
<div class="w-100 p-3 bg_eb radius_5 box_shadow_3">
    <div class="row row-7 ">
        @foreach ($listCheckbox as $key => $title)
            <div class="col-3 mb-3">
                <div class="checkbox_item d-flex align-content-center p-2 radius_5 border_main">
                    <label class="mb-0 mr-3 min_185 fs-13 text-capitalize">{{ $title }}</label>
                    @include('view_update.json_checkbox_item', 
                    ['name'=>$name.'['.$key.']', 'value'=>@$value[$key]])
                </div>
            </div>
        @endforeach
    </div>
</div>