<div class="d-flex align-items-end form-group">
    <div class="infor">
        @foreach ($fields as $field)
            @php
                $name = $field['name'];
                $field['value'] = !empty($data_field->{$name}) ? $data_field->{$name} : '';
                if (!empty($data_field)) {
                    $field['attr']['disable_field'] = 1;
                }
            @endphp
            @include('view_update.view', $field)
        @endforeach
    </div>
</div>