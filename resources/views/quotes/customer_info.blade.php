@foreach ($fields as $field)
    @php
        $field['value'] = !empty($data_customer[$field['name']]) ? $data_customer[$field['name']] : '';
    @endphp
    @include('view_update.view', $field)
@endforeach