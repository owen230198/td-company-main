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
                $arr_field['history_view'] = true;
                $field_old = $arr_field;
                $field_old['value'] = $detail['old'];
                $field_new = $arr_field;
                $field_new['value'] = $detail['new'];
            @endphp
            <div class="d-flex align-items-center">
                @include('view_table.'.$arr_field['type'], $field_old)
                <p class="mx-3"><i class="fa fa-long-arrow-right fs-18" aria-hidden="true"></i></p>
                @include('view_table.'.$arr_field['type'], $field_new)
            </div>
        </div>
    @endif
@endforeach