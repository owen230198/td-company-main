<div class="list_linking_view_update p-2 radius_5 box_shadow_3">
    <div class="list_linking_data">
        @if (!empty($value))
            @foreach ($value as $key => $linking_item)
                @include('customers.item_represent', ['index' => $key, 'value' => $linking_item])
            @endforeach
        @else
            @include('customers.item_represent', ['index' => 0])   
        @endif
    </div>
    @if (\GroupUser::isSale() || \GroupUSer::isAdmin() || \GroupUSer::isAccounting())
        <div class="d-flex justify-content-center">
            <button type="button" class="mr-2 main_button color_white bg_green border_green radius_5 font_bold sooth __submit_only_linking_data" data-customer={{ @$dataItem['id'] }}>
                <i class="fa fa-pencil mr-2 fs-14" aria-hidden="true"></i> Chỉnh sửa
            </button>
            <button type="button" class="main_button color_white bg_green border_green radius_5 font_bold sooth add_data_linking_button">
                <i class="fa fa-plus mr-2 fs-14" aria-hidden="true"></i> Thêm người liên hệ
            </button>
        </div>
    @endif
</div>