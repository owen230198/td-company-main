<div class="base_table_form_search">
  <form action="{{ asset('search-table/'.$tableItem['name']) }}" method="GET" class="form-group d-flex align-items-center row mb-0" id="form-search">
    @if (!empty($param_default))
        <input type="hidden" name="default_data" value='{{ $param_default }}'>
    @endif
    @if (!empty($nosidebar))
        <input type="hidden" name="nosidebar" value = '1'>
    @endif
    @php
      $data_search = @$data_search?$data_search:array()
    @endphp
    @foreach ($field_searchs as $field)
        @if (@$field['type'] == 'group')
          @php
              $type = !empty($field['type']) ? $field['type'] : 'text';
              $field['attr'] = !empty($field['attr']) ? json_decode($field['attr'], true) : [];
              $field['other_data'] = !empty($field['other_data']) ? json_decode($field['other_data'], true) : [];
          @endphp
          @include('view_search.'.$type, $field)    
        @else
          <div class="col-4 align-self-center">
            @include('view_search.view', ['field' => $field])
          </div>
        @endif
    @endforeach
  </form>
</div>