@foreach ($arr_detail as $key => $detail)
    @php
        $arr_field = getDetailTableField(['table_map' => $table_map, 'name' => $key, 'history' => 1]);
    @endphp 
    @if (!empty($arr_field))
        <div class="d-flex mb-2 align-items-center">
            <label class="mb-0 text-capitalize mr-3 d-flex min_150">
                {{ $arr_field['note'] }} :
            </label>
            @php
                $arr_field['value'] = $detail;
                $arr_field['history_view'] = true;
            @endphp
            @include('view_table.'.$arr_field['type'], $arr_field)
        </div>
    @endif
@endforeach