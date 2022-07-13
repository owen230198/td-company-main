@extends('index')
@section('content')
  {!! getBreadcrumb($tableItem['name'], 0, $tableItem['note']) !!}
  <div class="dashborad_content">
    <div class="form-decstop d-none d-lg-block">
      <div class="row align-items-center mb-24 align-items-center justify-content-between ">
        <div class="col-12">
           @include('table\form_search')
        </div>
        <div class="col-12 text-right">
          <div class="d-flex align-center mb-2 justify-content-end">
            <button type="submit" class="station-richmenu-main-btn-area mr-2" form="form-search" value="submit">
              <i class="fa fa-filter mr-2 fs-18" aria-hidden="true"></i>Tìm kiếm
            </button>
            @if ($tableItem['insert'] == 1)
              <a href="insert/{{ $tableItem['name'] }}" class="station-richmenu-main-btn-area">
                <i class="fa fa-plus mr-2 fs-18" aria-hidden="true"></i>Thêm mới
              </a>
            @endif
            @if ($tableItem['remove'])
              <button class="station-richmenu-main-btn-area mx-2 red_button" data-toggle="modal" data-target="#multiDeleteModal">
                <i class="fa fa-trash mr-2 fs-18" aria-hidden="true"></i>Xóa 
              </button>
            @endif
            <a href="" class="station-richmenu-main-btn-area">
              <i class="fa fa-book mr-2 fs-18" aria-hidden="true"></i>Trợ giúp
            </a>
          </div>
        </div>
      </div>
    </div>
    @include('table.table_base_view')
    <div class="paginate_view d-flex align-center justify-content-between">
     {{ $data_tables->links() }}
    </div>
  </div>
  @include('table\remove_confirm')
  @include('table\remove_confirm_check')
@endsection