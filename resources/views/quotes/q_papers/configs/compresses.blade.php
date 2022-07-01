@include('quotes.q_papers.active_view', ['icon'=>'compress', 'note'=>'Ép nhũ', 'key_act'=>'compress'])
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá tiền/SP:</label>
    <div class="d-block">
      <input class="form-control fs-15 short_input" type="number" name="compress[price]" value="" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá lượt/1 bát sp (không phải giá lượt/1 tờ in)</span>
    </div> 
  </div>   
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá khuôn/SP:</label>
    <div class="d-block">
      <input class="form-control fs-15 short_input" type="number" name="compress[shape]" value="" min="0">
      <span class="mt-2 w_available fs-12 color_red font-italic">Giá khuôn/1 bát sp (không phải giá khuôn/1 tờ in)</span>
    </div> 
  </div>  
  @include('quotes.select_devices', ['key_device' => 'compress'])
</div> 