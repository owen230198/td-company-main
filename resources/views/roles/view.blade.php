@extends('index')
@section('content')
{!! getBreadcrumb('n_roles', 0, 'Phân quyền') !!}
<div class="dashborad_content pt-3 position-relative">
  <form action="get-permissions" method="GET" class="formGetRole" enctype="multipart/form-data">
    <div class="form-group">
      <select name="group" class="form-control col-4 change_submit">
        <option value="">Chọn nhóm admin</option>
        @foreach ($list_groups as $option)
          <option value="{{ $option['id'] }}" {{ @$group&&$group==$option['id']?'selected':'' }}>
            {{ str_repeat('__', $option['level']).' '.$option['name']  }}
          </option>
        @endforeach
      </select>
    </div>
  </form>
  <div class="grantPermissonList mt-4 pt-4">
    <div class="list_permission container-fluid">
      @foreach ($limit_roles as $parent)
        @if ($parent['parent']==0)
          <div class="row row-7 mb-5 bg_main">
            <div class="col-12 py-2 px-3 color_white bg_main text-uppercase">
              <h2 class="fs-16">{{ $parent['note'] }} </h2> 
            </div>
            @foreach ($list_roles as $role)
              @if ($role['parent']==$parent['id'])
                <div class="col-lg-3 col_md_5 col-md-4 mb-3">
                  @php
                    $arr_role = getRoleIdByModule($group, $role['module_id'])
                  @endphp
                  <form action="update-permissions/{{ $arr_role['module_id'].'/'.$arr_role['role_id'] }}" method="POST" enctype="multipart/form-data" class="border_main bg_white adminAjaxForm">
                    @csrf
                    <h3 class="fs-15 p-2 mb-2 mx-3 border_bot text-center text-capitalize">{{ $role['note'] }}</h3>
                    <div class="detail_role px-3">
                      @if (@$role['view'])
                        <div class="form-group d-flex mb-2 py-2 border_bot_eb">
                          <label class="mb-0 mr-3 min_100">Xem</label>
                          @include('roles.checkbox',['name'=>'view', 'value'=>$arr_role['view']])
                        </div>  
                      @endif 
                      @if (@$role['insert'])
                        <div class="form-group d-flex mb-2 py-2 border_bot_eb">
                          <label class="mb-0 mr-3 min_100">Thêm</label>
                          @include('roles.checkbox',['name'=>'insert', 'value'=>$arr_role['insert']])
                        </div>  
                      @endif
                      @if (@$role['update'])
                        <div class="form-group d-flex mb-2 py-2 border_bot_eb">
                          <label class="mb-0 mr-3 min_100">Sửa</label>
                          @include('roles.checkbox',['name'=>'update', 'value'=>$arr_role['update']])
                        </div>  
                      @endif
                      @if (@$role['remove'])
                        <div class="form-group d-flex mb-2 py-2 border_bot_eb">
                          <label class="mb-0 mr-3 min_100">Xóa</label>
                          @include('roles.checkbox',['name'=>'remove', 'value'=>$arr_role['remove']])
                        </div>  
                      @endif
                      @if (@$role['copy'])
                        <div class="form-group d-flex mb-2 py-2 border_bot_eb">
                          <label class="mb-0 mr-3 min_100">Sao chép</label>
                          @include('roles.checkbox',['name'=>'copy', 'value'=>$arr_role['copy']])
                        </div>  
                      @endif
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