<div class="station-richmenu-main-search">
  <form action="{{ asset('search-table/'.$tableItem['name'].''.@$param_action) }}" method="GET" class="form-group d-flex align-items-center row mb-0" id="form-search">
    @php
      $data_search = @$data_search?$data_search:array()
    @endphp
    @foreach ($field_searchs as $field)
        <div class="col-4 align-self-center">
          @include('view_search.view', $field)
        </div>
    @endforeach
  </form>
</div>