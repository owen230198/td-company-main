@include('quotes.q_papers.active_view', ['icon'=>'superpowers', 'note'=>'Máy bế', 'key_act'=>'elevate'])
<div class="incredent_content mt-4">
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Sản phẩm có thúc nổi:</label>
    <input class="checkbox_configs" type="checkbox" name="elevate[float]" value="1">
  </div>
  <div class="d-flex align-items-center mb-3">
    <label class="base_label mr-2 mb-0 label_quotes">Giá khuôn của bài in:</label>
    <input class="form-control fs-15 short_input" type="number" name="elevate[shape_price]" value="" min="0">
  </div> 
  @include('quotes.select_devices', ['key_device' => 'elevate'])
</div> 