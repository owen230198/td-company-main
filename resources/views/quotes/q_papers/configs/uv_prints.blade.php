@php
  $data_uv = @$dataitem['uv']?json_decode($dataitem['uv'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'underline', 'note'=>'In UV', 'key_act'=>'uv', 'active'=>@$data_uv['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_uv['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Số mặt in</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="uv[num_face]">
          <option value="0" {{ @$data_uv['num_face']==0?'selected':'' }}>Chọn số mặt in</option>
          <option value="1" {{ @$data_uv['num_face']==1?'selected':'' }}>1</option>
          <option value="2" {{ @$data_uv['num_face']==2?'selected':'' }}>2</option>
        </select>
      </div>
    </div>
  </div>  
  @include('quotes.select_devices', ['key_device' => 'uv', 'device'=>@$data_uv['device']])
</div> 