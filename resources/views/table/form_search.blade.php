<div class="station-richmenu-main-search">
  <form action="{{ asset('search-table/'.$tableItem['name'].'') }}" method="GET" class="form-group d-flex align-items-center row mb-0" id="form-search">
    @php
      $data_search = @$data_search?$data_search:array()
    @endphp
    @foreach ($field_searchs as $field)
        <div class="col-4 mb_20 border_right_eb align-self-center">
          @include('view_search.'.$field["view_type"].'', ['field'=>$field, 'data_search'=>$data_search])
        </div>
    @endforeach
  </form>
</div>