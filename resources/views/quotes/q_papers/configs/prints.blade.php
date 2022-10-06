@php
  $data_print = @$dataitem['print']?json_decode($dataitem['print'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'print', 'note'=>'Kiểu in', 'key_act'=>'print', 'active'=>@$data_print['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_print['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Màu in</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select name="print[color_num]" class="form-control short_input">
          <option value="0"{{ @$data_print['color_num']==0?'selected':'' }}>Chọn số màu</option>
          @for ($i = 1; $i <7 ; $i++)
          <option value="{{ $i }}" {{ @$data_print['color_num']==$i?'selected':'' }}>{{ $i }}</option>
          @endfor
        </select>
      </div>
    </div>
  </div> 
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Kiểu in</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="print[style]">
          <option value="0" {{ @$data_print['color_num']==0?'selected':'' }}>Chọn kiểu in</option>
          <option value="1" {{ @$data_print['color_num']==1?'selected':'' }}>In một mặt</option>
          <option value="2" {{ @$data_print['color_num']==2?'selected':'' }}>Nó trở nó</option>
          <option value="3" {{ @$data_print['color_num']==3?'selected':'' }}>Nó trở lật</option>
          <option value="4" {{ @$data_print['color_num']==4?'selected':'' }}>Nó trở khác</option>
        </select>
      </div>
    </div>
  </div>
  <div class="d-flex align-items-center">
    <label class="base_label mr-2 mb-0 label_quotes">Thiết bị</label>
    <div class="d-flex align-items-center fs-13 mr-3 mb-md-0 mb-3">
      <div class="form-group d-flex align-items-center mb-0">
        <select class="form-control short_input" name="print[device]">
          <option value="0" {{ @$data_print['device']==0?'selected':'' }}>Chọn thiết bị</option>
          <option value="1" {{ @$data_print['device']==1?'selected':'' }}>In offset</option>
          <option value="2" {{ @$data_print['device']==2?'selected':'' }}>In UV</option>
        </select>
      </div>
    </div>
  </div>   
</div> 