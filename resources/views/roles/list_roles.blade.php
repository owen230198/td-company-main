@php
    $arrRoleTitle = \App\Constants\VariableConstant::ROLE_TITLE;
@endphp
<div class="grantPermissonList mt-4 pt-4 border_top_thin">
    <div class="list_permission container-fluid">
        @foreach ($limit_roles as $parent)
            @if ($parent['parent'] == 0)
                <div class="row row-7 mb-4 bg_main">
                    <div class="col-12 py-2 px-3 color_white bg_main text-uppercase">
                        <h2 class="fs-16">{{ $parent['note'] }} </h2>
                    </div>
                    @foreach ($list_roles as $role)
                        @if ($role['parent'] == $parent['id'])
                            <div class="col_md_5 col-3 mb-3">
                                @php
                                    $roleObj = getRoleIdByModule($group, $role['module_id']);
                                    $arrRolesGrant = !empty($role['json_data_role']) ? json_decode($role['json_data_role'], true):[];
                                    $listRole = !empty($roleObj['json_data_role']) ? json_decode($roleObj['json_data_role'], true):[];
                                @endphp
                                <form action="update-permissions/{{ $roleObj['module_id'] . '/' . $roleObj['role_id'] }}"
                                    method="POST" enctype="multipart/form-data" class="border_main bg_white adminAjaxForm h-100">
                                    @csrf
                                    <h3 class="fs-13 p-2 mb-2 mx-3 border_bot text-center text-capitalize">
                                        {{ $role['note'] }}</h3>
                                    <div class="detail_role px-3">
                                        @foreach ($arrRolesGrant as $key => $value)
                                            @if ($value == 1)
                                                @include('roles.item', ['name' => $key, 'value' => $value])
                                            @endif
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>