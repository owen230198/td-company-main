<div class="__cost_c_order_module">
    @foreach ($fields as $field)
        @php
            $name = $field['name'];
            $arr = processArrField($field);
            $arr['value'] = @$dataItem[$name];
        @endphp
        @include('view_update.view', $arr)
    @endforeach  
</div>