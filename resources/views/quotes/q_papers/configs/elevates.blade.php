@php
  $data_elevate = @$dataitem['elevate']?json_decode($dataitem['elevate'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'superpowers', 'note'=>'Máy bế', 'key_act'=>'elevate', 'active'=>@$data_elevate['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_elevate['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Sản phẩm có thúc nổi:</label>
    <input class="checkbox_configs" type="checkbox" name="elevate[float]" value="{{ @$data_elevate['float']?1:0 }}" {{ @$data_elevate['float']?'checked':'' }}>
  </div>
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá khuôn của bài in:</label>
    <input class="form-control fs-15 short_input" type="number" name="elevate[shape_price]" value="{{ @$data_elevate['shape_price']?$data_elevate['shape_price']:'' }}" min="0">
  </div> 
  @include('quotes.select_devices', ['key_device' => 'elevate', 'device'=>@$data_elevate['device']])
</div> 