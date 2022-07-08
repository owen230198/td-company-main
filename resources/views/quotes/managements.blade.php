@extends('index')
@section('content')
  @php
    $path_link = $tableItem['name'].'/'.$data_quotes['id'];
  @endphp
  <div class="dashborad_content">
    <meta name="ajax-url" content="ajax-view-list/{{ $path_link }}">
    <div class="form-decstop d-none d-lg-block">
      <div class="row align-items-center mb-24 align-items-center justify-content-between ">
        <div class="col-12 d-flex flex-wrap justify-content-between mb-2">
          <div class="d-flex align-center">
            <a href="{{ @session()->get('back_url') }}" class="station-richmenu-main-btn-area q_stage_btn mr-1">
              <i class="fa fa-th-list mr-2 fs-18" aria-hidden="true"></i>DS báo giá
            </a>
            <a href="quote-managements/q_papers/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn mr-1 {{ $tableItem['name']=='q_papers'?'active':'' }}">
              <i class="fa fa-file-o mr-2 fs-18" aria-hidden="true"></i>Tờ in
            </a>
            @if (@$data_quotes['group_product']=='hard_group')
              <a href="quote-managements/q_cartons/{{ $data_quotes['id'] }}?type=0" class="station-richmenu-main-btn-area q_stage_btn mr-1 {{ $tableItem['name']=='q_cartons'?'active':'' }}">
                <i class="fa fa-dropbox mr-2 fs-18" aria-hidden="true"></i>Vật tư cartons
              </a>
              <a href="quote-managements/q_foams/{{ $data_quotes['id'] }}?type=1" class="station-richmenu-main-btn-area q_stage_btn mr-1 {{ $tableItem['name']=='q_foams'?'active':'' }}">
                <i class="fa fa-barcode mr-2 fs-18" aria-hidden="true"></i>Mút xốp định hình
              </a>
              <a href="quote-managements/q_silks/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn mr-1 {{ $tableItem['name']=='q_silks'?'active':'' }}">
                <i class="fa fa-pied-piper mr-2 fs-18" aria-hidden="true"></i>Vật tư lụa
              </a>
              <a href="quote-managements/q_finishes/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn mr-1 {{ $tableItem['name']=='q_finishes'?'active':'' }}">
                <i class="fa fa-check-square-o mr-2 fs-18" aria-hidden="true"></i>Bồi & Hoàn thiện
              </a>    
            @endif
          </div>
          <div class="d-flex align-center justify-content-end">
            @if ($tableItem['insert'] == 1)
            <button type="button" class="station-richmenu-main-btn-area mx-2 load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="insert-detail-quotes/{{ $path_link }}">
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
    <div class="table_data">  
      @include('table.table_base_view')
    </div>
    <div class="paginate_view d-flex align-center justify-content-between">
     {{ $data_tables->links() }}
    </div>
  </div>
  @include('table.remove_confirm')
  @include('table.remove_confirm_check')
  @include('table.action_popup')
@endsection