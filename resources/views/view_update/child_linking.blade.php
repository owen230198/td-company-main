@php
    $select_data = !empty($other_data['data']) ? $other_data['data'] : [];
    $tableChildLinking = @$select_data['table'];
    $fieldChildLinking = @$select_data['field_query'];
    $passToItem = ['key_name' => $name, 'table' => $tableChildLinking];
    if (!empty($dataItem->id)) {
        $whereLinking = [$fieldChildLinking => $dataItem->id];
        $valueLikings = getModelByTable($tableChildLinking)::where($whereLinking)->take(10)->get()->toArray();
    }
@endphp
<div class="list_item_child_linking p-2 radius_5 box_shadow_3">
    <div class="list_child_linking_data">
        @if (!empty($valueLikings))
            @foreach ($valueLikings as $key => $linking_item)
                @php
                    $passToItem['index'] = $key; 
                    $passToItem['value'] = $linking_item
                @endphp
                @include('view_update.child_linkings.item', $passToItem)
            @endforeach
        @else
            @php
                $passToItem['index'] = 0
            @endphp
            @include('view_update.child_linkings.item', $passToItem)   
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <button 
        type="button" 
        class="main_button color_white bg_green border_green radius_5 font_bold sooth __add_item_child_linking_button" 
        data-table={{ $tableChildLinking }} data-key={{ $name }}>
            <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm {{ $note }}
        </button>
    </div>
</div>