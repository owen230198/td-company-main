@php
    $jindex = !empty($jindex) ? $jindex : 0;
@endphp
<div class="json_field_module">
    <div class="{{ @$attr['inject_class'] }} row ">
        @foreach ($other_data as $field_json)
            @php
                $jname = $field_json['name'];
                $field_json['name'] = $name.'['.$jindex.']['.$jname.']';
            @endphp
            @include('view_update.view', $field_json)
        @endforeach   
    </div>
</div>
