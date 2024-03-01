@php
    $model = getModelByTable($element['table']);
    $field_shows = $model::SUPPLY_FIELDS;
@endphp
<div class="table_base_view position-relative">
    <table class="table table-bordered mb-2 table_main">
        <tr>
            <th class="font-bold fs-13 text-center">
                <span>#</span>
            </th>
            <th class="font-bold fs-13">Tình trạng vật tư</th>
            @foreach ($field_shows as $key => $field)
                <th class="font-bold fs-13">
                    {{ $field['note'] }}
                </th>
            @endforeach
            <th class="font-bold fs-13">Chức năng</th>
        </tr>
        <tbody>
            @foreach ($element['data'] as $key => $data)
                <tr>
                    <td class="text-center">
                        <span>{{ $key+1 }}</span>
                    </td>
                    @php
                        $supp_handle_status = getHandleSupplyStatus($data->product, $data->id, @$element['pro_field']);
                        $bg_color = @$supp_handle_status == 'handled' ? 'stt_bg_green' : 
                                    (@$supp_handle_status == 'handling' ? 'stt_bg_blue' : 'stt_bg_red');
                        $stt_title = @$supp_handle_status == 'handled' ? 'Kế toán kho đã xử lí' : 
                                    (@$supp_handle_status == 'handling' ? 'Kế toán kho đang xử lí' : 'Cần xử lí ngay');
                    @endphp 
                    <td class="text-center {{ $bg_color }}">
                        <span class="color_white font_bold">{{ $stt_title }}</span>
                    </td>
                    @foreach ($field_shows as $field)
                    <td>
                        @php
                            $arr = $field;
                            $arr['obj_id'] = $data->id;
                            $arr['value'] = @$data->{$field['name']};
                            $arr['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];

                            if ($element['table'] == 'fill_finishes') {
                                $magnet = !empty($data->magnet) ? json_decode($data->magnet, true) : [];
                                if ($field['name'] == 'name') {
                                    $arr['value'] = !empty($magnet['type']) ? getFieldDataById('name', 'materals', $magnet['type']) : 'Nam châm';
                                }

                                if ($field['name'] == 'product_qty') {
                                    $arr['value'] = (int) @$magnet['qty'] * $data->product_qty;
                                }
                            }elseif ($element['table'] == 'supplies') {
                                $supp_size = !empty($data->size) ? json_decode($data->size, true) : [];
                                if (in_array(@$data->type, [\TDConst::DECAL, \TDConst::SILK])) {
                                    if ($field['name'] == 'name') {
                                        $arr['value'] = !empty($supp_size['supply_price']) ? getFieldDataById('name', 'materals', $supp_size['supply_price']) : 'Không xác định';
                                    }
                                    if ($field['name'] == 'supp_qty') {
                                        $arr['value'] = getBaseNeedQtySquareSupply($data->supp_qty, $supp_size);
                                    }
                                }else{
                                    if ($field['name'] == 'name') {
                                        $arr['value'] = !empty($supp_size['supply_price']) && !empty($supp_size['supply_type']) 
                                        ? getFieldDataById('name', 'supply_types', $supp_size['supply_type']) .' - '. getFieldDataById('name', 'supply_prices', $supp_size['supply_price']) : 'Không xác định';
                                    }
                                }
                            }
                        @endphp
                        @include('view_table.'.$field['type'], $arr)
                    </td>
                    @endforeach
                    <td>
                        <div class="func_btn_module text-center">
                            <a href="{{ url('supply-handle?table='.$element['table'].'&id='.$data->id) }}">
                                <i class="fa fa-paper-plane-o mr-1" aria-hidden="true"></i> Yêu cầu xuất vật tư
                            </a>   
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
