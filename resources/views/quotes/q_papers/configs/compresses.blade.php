@php
  $data_compress = @$dataitem['compress']?json_decode($dataitem['compress'], true):array();
@endphp
@include('quotes.q_papers.active_view', ['icon'=>'compress', 'note'=>'Ép nhũ', 'key_act'=>'compress', 'active'=>@$data_compress['act']])
<div class="incredent_content mt-4" style="display: {{ @$data_compress['act']?'block':'' }};">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá tiền/SP:</label>
    <div class="d-block">
      <input class="form-control fs-13 short_input" type="number" name="compress[price]" value="{{ @$data_compress['price'] }}" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá lượt/1 bát sp (không phải giá lượt/1 tờ in)</span>
    </div> 
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá khuôn/SP:</label>
    <div class="d-block">
      <input class="form-control fs-13 short_input" type="number" name="compress[shape]" value="{{ @$data_compress['shape'] }}" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá khuôn/1 bát sp (không phải giá khuôn/1 tờ in)</span>
    </div> 
  </div>  
  @include('quotes.select_devices', ['key_device' => 'compress', 'device'=>@$data_compress['device']])
</div> 