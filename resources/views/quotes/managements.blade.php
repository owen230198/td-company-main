@extends('index')
@section('content')
  <div class="dashborad_content">
    <div class="form-decstop d-none d-lg-block">
      <div class="row align-items-center align-items-center justify-content-between">
        <div class="col-12 d-flex flex-wrap justify-content-between mb-2 px-0">
          <div class="d-flex align-center justify-content-center mb-3 w-md-100">
            <a href="{{ @session()->get('back_url') }}" class="station-richmenu-main-btn-area q_stage_btn">
              <i class="fa fa-th-list mr-1 fs-15" aria-hidden="true"></i>DS báo giá
            </a>
            <a href="quote-managements/q_papers/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']=='q_papers'?'active':'' }}">
              <i class="fa fa-file-o mr-1 fs-15" aria-hidden="true"></i>Tờ in
            </a>
            @if (@$data_quotes['group_product']==\App\Constants\NameConstant::HARDBOX)
              <a href="quote-managements/q_cartons/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']=='q_cartons'?'active':'' }}">
                <i class="fa fa-dropbox mr-1 fs-15" aria-hidden="true"></i>Vật tư cartons
              </a>
              <a href="quote-managements/q_foams/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']=='q_foams'?'active':'' }}">
                <i class="fa fa-barcode mr-1 fs-15" aria-hidden="true"></i>Mút xốp
              </a>
              <a href="quote-managements/q_silks/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']=='q_silks'?'active':'' }}">
                <i class="fa fa-pied-piper mr-1 fs-15" aria-hidden="true"></i>Vật tư lụa
              </a>
              <a href="quote-managements/q_finishes/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']=='q_finishes'?'active':'' }}">
                <i class="fa fa-check-square-o mr-1 fs-15" aria-hidden="true"></i>Hoàn thiện
              </a>
            @endif
            <a href="config-profits/{{ $data_quotes['id'] }}" class="station-richmenu-main-btn-area q_stage_btn {{ @$tableItem['name']==null?'active':'' }}">
              <i class="fa fa-percent mr-1 fs-15" aria-hidden="true"></i>Lợi nhuận
            </a>     
          </div>
          @if (@$tableItem['name']!='q_finishes'&&@$tableItem['name']!=null)
            @php
              $path_link = @$tableItem['name'].'/'.@$data_quotes['id'];
            @endphp
            <meta name="ajax-url" content="ajax-view-list/{{ $path_link }}">
            <div class="d-flex align-center justify-content-end mb-3 w-md-100">
              @if ($tableItem['insert'] == 1)
              <button type="button" class="station-richmenu-main-btn-area load_view_popup" data-toggle="modal" data-target="#actionModal" data-src="insert-detail-quotes/{{ $path_link }}">
                <i class="fa fa-plus mr-1 fs-15" aria-hidden="true"></i>Thêm mới
              </button>
              @endif
              @if ($tableItem['remove'])
                <button class="station-richmenu-main-btn-area mx-2 red_button" data-toggle="modal" data-target="#multiDeleteModal">
                  <i class="fa fa-trash mr-1 fs-15" aria-hidden="true"></i>Xóa 
                </button>
              @endif
              <a href="" class="station-richmenu-main-btn-area">
                <i class="fa fa-book mr-1 fs-15" aria-hidden="true"></i>Trợ giúp
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
      @if (@$tableItem['name']=='q_finishes')
        @include('quotes.q_finishes.view', ['dataitem'=>@$data_tables[0]?(array)$data_tables[0]:array()])
      @elseif(@$tableItem['name']==null)
        @include('quotes.profits.view')
      @else
      <div class="table_data">
        @include('table.table_base_view')
        <div class="paginate_view d-flex align-center justify-content-between">
         {{ $data_tables->links() }}
        </div>
      </div>
      @include('table.remove_confirm')
      @include('table.remove_confirm_check')
      @include('table.action_popup')
      @endif  
  </div>
@endsection