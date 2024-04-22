<div class="dashborad_content position-relative mb-4 pb-4 border_bot">
    <form action="{{ $action_url }}" method="POST" class="config_content baseAjaxForm" enctype="multipart/form-data">
        @csrf
        <div class="warehouse_field_action">
            @if (!empty($default_field))
                @foreach ($default_field as $key => $df_value)
                    <input type="hidden" name = "warehouse[{{ $key }}]" value = "{{ $df_value }}">   
                @endforeach
            @endif
            @foreach ($field_list as $field)
                @if ($field['type'] == 'group')
                    @php
                        $attr = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
                        $other_data = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
                        $child = !empty($field['child']) ? $field['child'] : [];
                    @endphp
                    <div class="group_class_view {{ @$other_data['group_class'] }}" {{ @$other_data['inject_attr'] }}>
                        @foreach ($child as $field_child)
                            @php
                                $value_index = $field_child['name'];
                                $field_child['name'] = 'warehouse['.$field_child['name'].']';
                                $arr = processArrField($field_child);
                                $arr['value'] = @$dataItem[$value_index];
                            @endphp
                            @include('view_update.view', $arr)
                        @endforeach   
                    </div>
                @else
                    @php
                        $field =  (array) $field;
                        $value_index = $field['name'];
                        $field['name'] = 'warehouse['.$field['name'].']';
                        $arr = processArrField($field);
                        $arr['value'] = @$config_view == 1 ? @$field['value'] : @$dataItem[$value_index];
                    @endphp
                    @include('view_update.view', $arr)
                @endif
            @endforeach
            <input type="hidden" name="log[type]" value="{{ @$type_supp }}">
            @foreach ($field_logs as $field_log)
                @php
                    $field_log['name'] = 'log['.$field_log['name'].']';
                @endphp
                @include('view_update.view', $field_log)
            @endforeach
        </div>
        <div class="group_btn_action_form text-center">
            <button type="submit" disabled class="main_button color_white bg_green border_green radius_5 font_bold smooth">
                <i class="fa fa-check mr-2 fs-14" aria-hidden="true"></i>Hoàn tất
            </button>
            <a href="{{ getBackUrl() }}"
                class="main_button color_white bg_green radius_5 font_bold smooth mx-3">
                <i class="fa fa-angle-double-left mr-2 fs-14" aria-hidden="true"></i>Trở về
            </a>
            <a href="{{ url('') }}" class="main_button bg_red color_white radius_5 font_bold smooth red_btn">
                <i class="fa fa-times mr-2 fs-14" aria-hidden="true"></i>Hủy
            </a>
        </div>
    </form>
</div>