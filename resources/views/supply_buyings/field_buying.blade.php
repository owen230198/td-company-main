@foreach ($fields as $field)
    @php
        $goup_name = 'supply['.$index.']';
        $name = $field['name'];
        $field['name'] = $goup_name.'['.$name.']';
        $arr = processArrField($field);
        $arr['min_label'] = 150;
        $arr['default_field']['type'] = $type;
        $arr['value'] = @$group_value[$name];
        $arr['group_name'] = $goup_name;
        if (!\GroupUser::isPlanHandle()) {
            $arr['attr']['readonly'] = 1;
        }
        if ((\GroupUser::isDoBuying() || \GroupUser::isAdmin()) && in_array(@$dataItem['status'], [\StatusConst::PROCESSING, \StatusConst::NOT_ACCEPTED]) && in_array($name, ['width', 'length'])) {
            $arr['attr']['readonly'] = 0;
        }
    @endphp
    @if ($field['name'] != 'created_at')
        @include('view_update.view', $arr)         
    @endif  
@endforeach