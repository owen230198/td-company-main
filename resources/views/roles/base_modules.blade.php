@if (@$role['view'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Xem</label>
        @include('roles.checkbox', ['name' => 'view', 'value' => $arr_role['view']])
    </div>
@endif
@if (@$role['insert'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Thêm</label>
        @include('roles.checkbox', ['name' => 'insert', 'value' => $arr_role['insert']])
    </div>
@endif
@if (@$role['update'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Sửa</label>
        @include('roles.checkbox', ['name' => 'update', 'value' => $arr_role['update']])
    </div>
@endif
@if (@$role['remove'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Xóa</label>
        @include('roles.checkbox', ['name' => 'remove', 'value' => $arr_role['remove']])
    </div>
@endif
@if (@$role['copy'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Sao chép</label>
        @include('roles.checkbox', ['name' => 'copy', 'value' => $arr_role['copy']])
    </div>
@endif
@if (@$role['view_my'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Chỉ xem data của mình</label>
        @include('roles.checkbox', ['name' => 'view_my', 'value' => $arr_role['view_my']])
    </div>
@endif
@if (@$role['update_my'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Chỉ sửa data của mình</label>
        @include('roles.checkbox', ['name' => 'update_my', 'value' => $arr_role['update_my']])
    </div>
@endif
@if (@$role['remove_my'])
    <div class="form-group d-flex mb-2 py-2 border_bot_eb">
        <label class="mb-0 mr-3 min_155">Chỉ xóa data của mình</label>
        @include('roles.checkbox', ['name' => 'remove_my', 'value' => $arr_role['remove_my']])
    </div>
@endif
