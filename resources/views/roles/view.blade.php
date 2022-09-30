@extends('index')
@section('content')
    {!! getBreadcrumb('n_roles', 0, 'Phân quyền') !!}
    <div class="dashborad_content pt-3 position-relative">
        <form action="get-permissions" method="GET" class="formGetRole" enctype="multipart/form-data">
            <div class="form-group">
                <select name="group" class="form-control col-4 change_submit">
                    <option value="">Chọn nhóm admin</option>
                    @foreach ($list_groups as $option)
                        <option value="{{ $option['id'] }}" {{ @$group && $group == $option['id'] ? 'selected' : '' }}>
                            {{ str_repeat('__', $option['level']) . ' ' . $option['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="grantPermissonList mt-4 pt-4">
            <div class="list_permission container-fluid">
                @foreach ($limit_roles as $parent)
                    @if ($parent['parent'] == 0)
                        <div class="row row-7 mb-5 bg_main">
                            <div class="col-12 py-2 px-3 color_white bg_main text-uppercase">
                                <h2 class="fs-16">{{ $parent['note'] }} </h2>
                            </div>
                            @foreach ($list_roles as $role)
                                @if ($role['parent'] == $parent['id'])
                                    <div class="col-lg-3 col_md_5 col-md-4 mb-3">
                                        @php
                                            $arr_role = getRoleIdByModule($group, $role['module_id']);
                                        @endphp
                                        <form
                                            action="update-permissions/{{ $arr_role['module_id'] . '/' . $arr_role['role_id'] }}"
                                            method="POST" enctype="multipart/form-data"
                                            class="border_main bg_white adminAjaxForm">
                                            @csrf
                                            <h3 class="fs-15 p-2 mb-2 mx-3 border_bot text-center text-capitalize">
                                                {{ $role['note'] }}</h3>
                                            <div class="detail_role px-3">
                                                @php
                                                    if (in_array(@$role['table_map'], \App\Constants\VariableConstant::ROLE_SELF_TABLE)) {
                                                        $arrRoles = getModelByTable($role['table_map'])::$roleSelf;  
                                                    }elseif (in_array(@$role['table_map'], \App\Constants\VariableConstant::CONFIG_TABLE)) {
                                                        $arrRoles =  \App\Constants\VariableConstant::CONFIG_TABLE_ROLE;
                                                    }else{
                                                        $arrRoles =  \App\Constants\VariableConstant::BASE_ROLE;
                                                    } 
                                                @endphp
                                                @foreach ($arrRoles as $key => $item)
                                                    @include('roles.item', ['roleIndex' => $key, 'roleName' => $item])
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
    </div>
@endsection
