<div class="base_table_form_search">
  <form action="{{ asset('search-table/'.$tableItem['name']) }}" method="GET" class="form-group d-flex align-items-center row mb-0" id="form-search">
    @if (!empty($param_default))
        <input type="hidden" name="default_data" value='{{ $param_default }}'>
    @endif
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