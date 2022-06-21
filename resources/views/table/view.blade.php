@extends('index')
@section('content')
<div class="dashborad_content">
  <div class="form-decstop d-none d-lg-block">
    <div class="row align-items-center mb-24 align-items-center justify-content-between ">
      <div class="col-12 text-right">
        <div class="d-flex align-center mb-2 justify-content-end">
          <a href="{{ asset('insert/'.$tableItem->name.'') }}" class="station-richmenu-main-btn-area mx-2">
            <i class="fa fa-plus mr-2 fs-18" aria-hidden="true"></i>Thêm mới
          </a>
          @if (@$tableItem->export)
            <a href="{{ asset('export/'.$tableItem->name.'') }}" class="station-richmenu-main-btn-area mx-2">
              <i class="fa fa-file-excel-o mr-2 fs-18" aria-hidden="true"></i>Export Excel
            </a>
          @endif
          @if (@$tableItem->import)
            <form action="{{ asset('import/'.$tableItem->model.'') }}" method="POST" class="uploadFileForm" enctype="multipart/form-data">
              @csrf
              <div class="upload_click position-relative">
                <button class="station-richmenu-main-btn-area mx-2">
                <i class="fa fa-upload mr-2 fs-18 upload_btn" aria-hidden="true"></i>Import Excel
                </button>
                <input type="file" name="file" value="" class="upload_input file_input change_submit" multiple>
              </div>
            </form>
          @endif
          <button class="station-richmenu-main-btn-area mx-2" data-toggle="modal" data-target="#multiDeleteModal">
              <i class="fa fa-trash mr-2 fs-18" aria-hidden="true"></i>Xóa 
          </button>
        </div>
      </div>
    </div>
  </div>
  <table class="table table_view_base">
    <tr>
      <th class="font-bold fs-15 text-center">#</th>
      <th class="font-bold fs-15 text-center"><input type="checkbox" class="c_all_remove"></th>
      @foreach ($field_shows as $field)
        <th class="font-bold fs-15">{{ $field['note'] }}</th>
      @endforeach
      <th class="font-bold fs-15">Chức năng</th>
    </tr>
   @foreach ($data_tables as $key => $data)
     <tr>
      <td class="text-center">
        {{ $key + 1 }}
      </td>
      <td class="text-center">
        <input type="checkbox" class="c_one_remove" data-id="{{ $data['_id'] }}">
      </td>
      @foreach ($field_shows as $field)
        <td>
          @include('view_table\\'.$field['view_type'].'', array('data'=>$data)) 
        </td>
      @endforeach
      <td>
        @include('table\func_btn') 
      </td>
    </tr>
   @endforeach
  </table>
  <div class="paginate_view d-flex align-center justify-content-between">
    {{ $data_tables->onEachSide(5)->links() }}
  </div>
</div>
@include('table\remove_confirm')
@include('table\remove_confirm_check')
@stop