@extends('index')
@section('content')
  {!! getBreadcrumb($tableItem['name'], 0, $tableItem['note']) !!}
  <div class="dashborad_content">
    <div class="form-decstop d-none d-lg-block">
      <div class="row align-items-center mb-24 align-items-center justify-content-between ">
        <div class="col-12 text-right">
          <div class="d-flex align-center mb-2 justify-content-end">
            @if ($tableItem['insert'] == 1)
            <button type="button" class="station-richmenu-main-btn-area mx-2 load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="insert-detail-quotes/q_papers/{{ $data_quotes['id'] }}">
              <i class="fa fa-plus mr-2 fs-18" aria-hidden="true"></i>Thêm mới
            </button>
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
  @include('table.remove_confirm')
  @include('table.remove_confirm_check')
  @include('table.action_popup')
@endsection