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
            <button type="submit" class="station-richmenu-main-btn-area" form="form-search" value="submit">
              <i class="fa fa-filter mr-2 fs-18" aria-hidden="true"></i>Tìm kiếm
            </button>
            @if ($tableItem['insert'] == 1)
              <a href="{{ $tableItem['insert_link'] == 1?'action-to-view/insert':'insert' }}/{{ $tableItem['name'] }}" class="station-richmenu-main-btn-area mx-2">
                <i class="fa fa-plus mr-2 fs-18" aria-hidden="true"></i>Thêm mới
              </a>
            @endif
            <a href="" class="station-richmenu-main-btn-area">
              <i class="fa fa-book mr-2 fs-18" aria-hidden="true"></i>Trợ giúp
            </a>
          </div>
        </div>
      </div>
    </div>
    <table class="table">
      <tr>
        <th class="font-bold fs-15 text-center">#</th>
        <th class="font-bold fs-15 text-center"><input type="checkbox" class="c_all_remove"></th>
        @foreach ($field_shows as $field)
          <th class="font-bold fs-15">{{ $field['note'] }}</th>
        @endforeach
        <th class="font-bold fs-15">Chức năng</th>
      </tr>
      @foreach ($data_tables as $key => $data)
        @php
          $data = (array)$data;
        @endphp
        <tr>
          <td>
            {{ $key + 1 }}
          </td>
          <td class="text-center">
            <input type="checkbox" class="c_one_remove" data-id="{{ $data['id'] }}">
          </td>
          @foreach ($field_shows as $field)
            <td>
               @include('view_table.'.$field['view_type'].'',['data'=>$data, 'field'=>$field]) 
            </td>
          @endforeach
          <td>
             @include('table.'.$tableItem['function_view'].'func_btn', array('data'=>$data))
          </td>
        </tr>
      @endforeach
    </table>
    <div class="paginate_view d-flex align-center justify-content-between">
     {{ $data_tables->links() }}
    </div>
  </div>
  @include('table\remove_confirm')
  @include('table\remove_confirm_check')
@endsection