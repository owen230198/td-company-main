@extends('index')
@section('content')
<div class="dashborad_content pt-3 position-relative">
  <form action="get-permissions" method="GET" class="formGetRole" enctype="multipart/form-data">
    <div class="form-group d-flex align-items-center">
      <select name="group" class="form-control col-4 chose_group_admin change_submit mr-3">
        <option value="">Chọn nhóm admin</option>
        @foreach ($list_groups as $option)
          <option value="{{ $option['_id'] }}" {{ @$group&&$group==$option['_id']?'selected':'' }}>
              {{ $option['name'] }}
            </option>
        @endforeach
      </select>
      <button type="button" class="btn-primary guide_btn guide_btn_ajax" data-toggle="modal" data-target="#guideModal" data-route="{{ asset('get-data-guides/permission-guides') }}">
        <i class="fa fa-question-circle fs-25 color_main" aria-hidden="true"></i>
      </button>
    </div>
  </form>
  <div class="grantPermissonList mt-4 pt-4">
    <div class="list_permission container-fluid">
      @foreach ($limit_roles as $parent)
        @if ($parent['parent']==0)
          <div class="row row-7 mb-5 bg_main">
            <div class="col-12 py-2 px-3 color_white bg_main text-uppercase">
              <h2 class="fs-16">{{ $parent['note'] }}</h2> 
            </div>
            @foreach ($list_roles->toArray() as $role)
              @php
                 $arr_role = getRoleByModule($group, $role['module_id']);
                 $arr_module =getDetailDataByID('NModule', $role['module_id']);
              @endphp
              @if ($arr_module['parent']==$parent['id'])
                <div class="col-md-3 mb_30">
                  <form action="{{ asset('update-permissions/'.$arr_role['module_id'].'/'.$arr_role['_id'].'') }}" method="POST" enctype="multipart/form-data" class="border_main bg_white">
                    @csrf
                    <h3 class="fs-15 p-2 mb-2 mx-3 border_bot text-center text-capitalize">
                    {{ $arr_module['note'] }}
                    </h3>
                    <div class="detail_role px-3">
                    @if (@$role['view'])
                      <div class="form-group d-flex mb-3 py-3 border_bot_eb">
                        <label class="mb-0 mr-3 min_100">Xem</label>
                        @include('roles\checkbox',['name'=>'view', 'value'=>$arr_role['view']])
                      </div>
                    @endif
                    @if (@$role['insert'])
                      <div class="form-group d-flex mb-3 py-3 border_bot_eb">
                        <label class="mb-0 mr-3 min_100">Thêm</label>
                        @include('roles\checkbox',['name'=>'insert', 'value'=>$arr_role['insert']])
                      </div> 
                    @endif
                    @if (@$role['update'])
                      <div class="form-group d-flex mb-3 py-3 border_bot_eb">
                        <label class="mb-0 mr-3 min_100">Sửa</label>
                        @include('roles\checkbox',['name'=>'update', 'value'=>$arr_role['update']])
                      </div> 
                    @endif 
                    @if (@$role['remove'])
                      <div class="form-group d-flex mb-3 py-3 border_bot_eb">
                        <label class="mb-0 mr-3 min_100">Xóa</label>
                        @include('roles\checkbox',['name'=>'remove', 'value'=>$arr_role['remove']])
                      </div> 
                    @endif 
                    @if (@$role['copy'])
                      <div class="form-group d-flex mb-3 py-3 border_bot_eb">
                        <label class="mb-0 mr-3 min_100">Sao chép</label>
                        @include('roles\checkbox',['name'=>'copy', 'value'=>$arr_role['copy']])
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