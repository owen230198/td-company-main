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
        @if (!empty($limit_roles))
            @include('roles.list_roles')
        @endif
    </div>
@endsection
